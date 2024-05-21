<?php

namespace App\Routes;

use App\Core\Request;
use App\Core\Response;
use App\Core\Container;
use App\Core\MiddlewarePipeline;

class Router
{
    protected $container;
    protected $routes = [];

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function add($method, $uri, $action)
    {
        $this->routes[strtoupper($method)][$uri] = $action;
    }

    public function get($uri, ...$action)
    {
        $this->add('GET', $uri, $action);
    }

    public function post($uri, ...$action)
    {
        $this->add('POST', $uri, $action);
    }

    public function put($uri, ...$action)
    {
        $this->add('PUT', $uri, $action);
    }

    public function delete($uri, ...$action)
    {
        $this->add('DELETE', $uri, $action);
    }

    public function dispatch(Request $request)
    {
        $uri = trim($request->getPath(), '/');
        $method = $request->getMethod();

        if (!isset($this->routes[$method][$uri])) {
            return new Response('Route not found', 404);
        }

        $actions = $this->routes[$method][$uri];
        $pipeline = new MiddlewarePipeline($this->container);

        foreach ($actions as $step) {
            if (is_string($step) && class_exists($step)) {
                $pipeline->pipe($this->container->make($step));
            } elseif (is_array($step)) {
                list($class, $method) = $step;
                $controller = $this->container->make($class);
                $middleware = function ($request, $next) use ($controller, $method) {
                    return $controller->$method($request, $next);
                };
                $pipeline->pipe($middleware);
            }
        }

        return $pipeline->run($request);
    }
}
