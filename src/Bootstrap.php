<?php

namespace Waf;

use Waf\Http\Request;

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
        if (!defined('APP_THREAD_ID')) {
            define('APP_THREAD_ID', substr(md5(APP_TIME_FLOAT), 0, 6));
        }
    }

    public function _initConfig()
    {
        $config = \Yaf\Application::app()->getConfig();
        \Yaf\Registry::set('config', $config);
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
        require APP_PATH . '/di.php';
    }

}
