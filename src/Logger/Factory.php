<?php

namespace Waf\Logger;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
use Waf\Logger\Processor\HostNameProcessor;
use Waf\Logger\Processor\RequestIdProcessor;

class Factory
{

    private static $instance = null;
    private static $instantiatedLoggers = [];
    private $pathRoot;
    private $pathFormat;

    /**
     * 
     * @return Waf\Logger\Factory
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $this->pathRoot = config('log.path.root');
        $this->pathFormat = config('log.path.format');
    }

    public function getLogger($channel)
    {
        if (!isset(self::$instantiatedLoggers[$channel])) {
            $logger = new Logger($channel);
            $logger->pushProcessor(new HostNameProcessor());
            $logger->pushProcessor(new RequestIdProcessor());
            $formatter = new LineFormatter(null);
            $streamHandler = new StreamHandler("{$this->pathRoot}/{$channel}" . date($this->pathFormat) . ".log", Logger::INFO);
            $streamHandler->setFormatter($formatter);
            $logger->pushHandler($streamHandler);
            self::$instantiatedLoggers[$channel] = $logger;
        }
        return self::$instantiatedLoggers[$channel];
    }

    public function getDefaultLogger()
    {
        return $this->getLogger('_default');
    }

    public function getRuntimeErrorLogger()
    {
        return $this->getLogger('_runtime');
    }

    public function getErrorLogger()
    {
        return $this->getLogger('_error');
    }

    public function getRequestLogger()
    {
        return $this->getLogger('_request');
    }

    public function getSqlLogger()
    {
        return $this->getLogger('_sql');
    }

}
