<?php

/**
 * 
 * @author Dawei Zhang <ctmaster@126.com>
 */
use \Yaf\Registry;

if (!function_exists('config')) {

    function config($key = null)
    {
        $config = Registry::get('config')->toArray();
        if (!$config) {
            return null;
        }

        if ($key === null) {
            return $config;
        }

        $subKeys = explode('.', $key);
        $tmpValue = $config;
        foreach ($subKeys as $subKey) {
            if (!isset($tmpValue[$subKey])) {
                return null;
            }
            $tmpValue = $tmpValue[$subKey];
        }
        return $tmpValue;
    }

}

if (!function_exists('app')) {

    function app($name)
    {
        $di = Registry::get('di');
        if (!$di) {
            return null;
        }
        return $di->get($name);
    }

}