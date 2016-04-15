<?php

namespace Waf\DI;

use Auryn\Injector;
use Closure;

class Container
{

    private $injector;

    public function __construct()
    {
        $this->injector = new Injector();
    }

    public function set($name, Closure $closure)
    {
        return $this->injector->delegate($name, $closure);
    }

    public function get($name)
    {
        return $this->injector->make($name);
    }

    public function make($name, array $args = array())
    {
        return $this->injector->make($name, $args);
    }

}
