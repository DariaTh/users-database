<?php

require_once 'vendor/autoload.php';

use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;

$log = new Logger('CRUD');

$debugHandler = new StreamHandler('debug.log', Logger::DEBUG);

$log->pushHandler($debugHandler);
