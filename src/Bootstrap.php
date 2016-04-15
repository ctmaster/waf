<?php

namespace Waf;

use Waf\Http\Request;
use Waf\DI\DefaultFactory;
use Illuminate\Database\Capsule\Manager as Capsule;

class Bootstrap extends \Yaf\Bootstrap_Abstract
{

    public function _initGlobalConst()
    {
        if (!defined('APP_TIME')) {
            define('APP_TIME', $_SERVER['REQUEST_TIME']);
        }
        if (!defined('APP_TIME_FLOAT')) {
            define('APP_TIME_FLOAT', $_SERVER['REQUEST_TIME_FLOAT']);
        }
        if (!defined('APP_REQUEST_ID')) {
            define('APP_REQUEST_ID', substr(md5(APP_TIME_FLOAT), 0, 6));
        }
    }

    public function _initConfig()
    {
        $config = \Yaf\Application::app()->getConfig();
        \Yaf\Registry::set('config', $config);
    }

    public function _initTimezone()
    {
        date_default_timezone_set(\Yaf\Registry::get('config')->application->timezone);
    }

    public function _initRequest(\Yaf\Dispatcher $dispatcher)
    {
        $request = new Request();
        $dispatcher->setRequest($request);
    }

    public function _initCli(\Yaf\Dispatcher $dispatcher)
    {
        if ($dispatcher->getRequest()->isCli()) {
            $request = new \Yaf\Request\Simple();
            $dispatcher->setRequest($request);
        }
    }

    public function _initDisableView(\Yaf\Dispatcher $dispatcher)
    {
        $dispatcher->disableView();
    }

    public function _initLoadDI(\Yaf\Dispatcher $dispatcher)
    {
        $di = DefaultFactory::getInstance()->getDI();
        \Yaf\Registry::set('di', $di);
    }

    public function _initDatabase(\Yaf\Dispatcher $dispatcher)
    {
        $capsule = new Capsule();
        $capsule->addConnection(config('database'));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    public function _initFacades(\Yaf\Dispatcher $dispatcher)
    {
        $aliases = [
            'DB' => 'Waf\Facades\DB',
        ];
        foreach ($aliases as $k => $v) {
            class_alias($v, $k);
        }
    }

}
