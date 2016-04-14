<?php

namespace Waf\DI;

use Waf\DI\Container;
use Waf\Logger\Factory as LoggerFactory;

class DefaultFactory
{

    public static function getInstance()
    {
        return new self();
    }

    private function __construct()
    {
        
    }

    public function getDI()
    {
        $container = new Container();

        $container->set('log', function() {
            return LoggerFactory::getInstance()->getDefaultLogger();
        });

        $container->set('error_log', function() {
            return LoggerFactory::getInstance()->getErrorLogger();
        });

        return $container;
    }

}
