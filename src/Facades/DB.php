<?php

namespace Waf\Facades;

class DB extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'db';
    }

}
