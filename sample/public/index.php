<?php

define('PROJECT_PATH', realpath(dirname(__DIR__)));
define('APP_PATH', PROJECT_PATH . '/App');
require PROJECT_PATH . '/vendor/autoload.php';

$application = new \Yaf\Application(PROJECT_PATH . '/conf/application.ini', 'product');
$application->bootstrap()->run();
