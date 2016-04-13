<?php

namespace Waf\Http;

class Controller extends \Yaf\Controller_Abstract
{

    public function init()
    {
        \Yaf\Dispatcher::getInstance()->disableView();
    }

}
