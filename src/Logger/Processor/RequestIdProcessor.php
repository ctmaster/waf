<?php

namespace Waf\Logger\Processor;

class RequestIdProcessor
{

    private static $requestId = null;

    private static function getRequestId()
    {
        if (self::$requestId === null) {
            if (defined('APP_REQUEST_ID')) {
                self::$requestId = APP_REQUEST_ID;
            } else {
                self::$requestId = self::generateRequestId();
            }
        }
        return self::$requestId;
    }

    private static function generateRequestId()
    {
        return substr(md5($_SERVER['REQUEST_TIME_FLOAT']), 0, 6);
    }

    public function __invoke(array $record)
    {
        $record['extra']['rid'] = self::getRequestId();
        return $record;
    }

}
