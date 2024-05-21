<?php

namespace App\Core;

use Closure;
use Exception;

class Container
{
    protected $bindings = [];

    public function bind($abstract, $concrete = null)
    {
        if (is_null($concrete)) {
            $concrete = $abstract;
        }

        if (!$concrete instanceof Closure) {
            $concrete = function ($container) use ($concrete) {
                return $container->build($concrete);
            };
        }

        $this->bindings[$abstract] = $concrete;
    }

    public function make($abstract)
    {
        
        if (!isset($this->bindings[$abstract])) {
            throw new Exception("No binding found for {$abstract}");
        }

        return $this->bindings[$abstract]($this);
    }

    public function build($concrete)
    {
        $reflector = new \ReflectionClass($concrete);
       
        if (!$reflector->isInstantiable()) {
            throw new Exception("Class {$concrete} is not instantiable.");
        }

        $constructor = $reflector->getConstructor();

        if (is_null($constructor)) {
            return new $concrete;
        }

        $parameters = $constructor->getParameters();
        $dependencies = $this->resolveDependencies($parameters);

        return $reflector->newInstanceArgs($dependencies);
    }

    protected function resolveDependencies($parameters)
{
    $dependencies = [];

    foreach ($parameters as $parameter) {
        $dependency = $parameter->getType();

        if (is_null($dependency)) {
            if ($parameter->isDefaultValueAvailable()) {
                $dependencies[] = $parameter->getDefaultValue();
            } else {
                throw new Exception("Cannot resolve the unknown dependency {$parameter->name}.");
            }
        } else {
           
            $dependencyName = $dependency->getName();
            if ($dependencyName !== null) {
                $dependencies[] = $this->make($dependencyName);
            } else {
                throw new Exception("Cannot resolve the unknown dependency {$parameter->name}.");
            }
        }
    }

    return $dependencies;
}


    protected function resolvePrimitive($parameter)
    {
        if ($parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }

        throw new Exception("Cannot resolve the unknown dependency {$parameter->name}.");
    }
}
