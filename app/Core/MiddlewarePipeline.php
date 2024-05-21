<?php
namespace App\Core;

class MiddlewarePipeline
{
    protected $container;
    protected $middleware = [];

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function run($request)
    {
        $pipeline = array_reduce(
            array_reverse($this->middleware),
            function ($next, $middleware) {
                return function ($request) use ($middleware, $next) {
                    if (is_callable($middleware)) {
                        return $middleware($request, $next);
                    }

                    return $middleware->handle($request, $next);
                };
            },
            function ($request) {
                return new Response('Middleware pipeline finished', 200);
            }
        );

        return $pipeline($request);
    }

    public function pipe($middleware)
    {
        if (is_string($middleware) && class_exists($middleware)) {
            $middleware = $this->container->make($middleware);
        }
        $this->middleware[] = $middleware;
       
        return $this;
    }
}
