<?php

namespace Waf\Facades;

abstract class Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        throw new RuntimeException('Facade does not implement getFacadeAccessor method.');
    }

    public static function __callStatic($method, $args)
    {
        $instance = app(static::getFacadeAccessor());
        if (!$instance || !method_exists($instance, $method)) {
            throw new RuntimeException(static::class . ' does not have ' . $method . ' method.');
        }

        return call_user_func_array([$instance, $method], $args);
    }

}
