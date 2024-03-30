<?php

namespace Vagnerlg\MongolidPoc;

use Closure;
use Exception;
use Illuminate\Contracts\Container\Container as IlluminateContainer;

class DependencyInjection implements IlluminateContainer
{
    public function __construct(private array $classNames)
    {
    }

    public function makeWith($abstract, array $parameters = [])
    {
        return $this->make($abstract, $parameters);
    }

    public function make($abstract, array $parameters = [])
    {
        if (isset($this->classNames[$abstract])) {
            return $this->classNames[$abstract]($parameters);
        }

        throw new Exception("Class $abstract Not Found: " . json_encode($parameters));
    }

    public function bound($abstract)
    {
        // TODO: Implement bound() method.
    }

    public function alias($abstract, $alias)
    {
        // TODO: Implement alias() method.
    }

    public function tag($abstracts, $tags)
    {
        // TODO: Implement tag() method.
    }

    public function tagged($tag)
    {
        // TODO: Implement tagged() method.
    }

    public function bind($abstract, $concrete = null, $shared = false)
    {
        // TODO: Implement bind() method.
    }

    public function bindMethod($method, $callback)
    {
        // TODO: Implement bindMethod() method.
    }

    public function bindIf($abstract, $concrete = null, $shared = false)
    {
        // TODO: Implement bindIf() method.
    }

    public function singleton($abstract, $concrete = null)
    {
        // TODO: Implement singleton() method.
    }

    public function singletonIf($abstract, $concrete = null)
    {
        // TODO: Implement singletonIf() method.
    }

    public function scoped($abstract, $concrete = null)
    {
        // TODO: Implement scoped() method.
    }

    public function scopedIf($abstract, $concrete = null)
    {
        // TODO: Implement scopedIf() method.
    }

    public function extend($abstract, Closure $closure)
    {
        // TODO: Implement extend() method.
    }

    public function instance($abstract, $instance)
    {
        // TODO: Implement instance() method.
    }

    public function addContextualBinding($concrete, $abstract, $implementation)
    {
        // TODO: Implement addContextualBinding() method.
    }

    public function when($concrete)
    {
        // TODO: Implement when() method.
    }

    public function factory($abstract)
    {
        // TODO: Implement factory() method.
    }

    public function flush()
    {
        // TODO: Implement flush() method.
    }

    public function call($callback, array $parameters = [], $defaultMethod = null)
    {
        // TODO: Implement call() method.
    }

    public function resolved($abstract)
    {
        // TODO: Implement resolved() method.
    }

    public function beforeResolving($abstract, Closure $callback = null)
    {
        // TODO: Implement beforeResolving() method.
    }

    public function resolving($abstract, Closure $callback = null)
    {
        // TODO: Implement resolving() method.
    }

    public function afterResolving($abstract, Closure $callback = null)
    {
        // TODO: Implement afterResolving() method.
    }

    public function get(string $id)
    {
        // TODO: Implement get() method.
    }

    public function has(string $id): bool
    {
        return false;
        // TODO: Implement has() method.
    }
}