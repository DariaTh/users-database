<?php

require_once 'vendor/autoload.php';

use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;

$log = new Logger('name');

//$formatter = new LineFormatter(null, null, false, true);

$debugHandler = new StreamHandler('debug.log', Logger::DEBUG);
//$debugHandler->setFormatter($formatter);

$errorHandler = new StreamHandler('error.log', Logger::ERROR);
//$errorHandler->setFormatter($formatter);

$log->pushHandler($debugHandler);
$log->pushHandler($errorHandler);

$log->debug('I am debug');
//$log->error('I am error', array('productId' => 123));
$log->info('Adding a new user', array('name' => 'Seldaek'));
$log->info("Will have {name} for {country}", array('name' => $name, 'country' => $country));