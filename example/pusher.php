<?php

require_once 'vendor/autoload.php';

use UrbanAirship\Airship;
use UrbanAirship\UALog;
use UrbanAirship\Push as P;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

UALog::setLogHandlers(array(new StreamHandler("php://stdout", Logger::INFO)));
$airship = new Airship("key", "secret");

$response = $airship->push()
    ->setAudience(P\all)
    ->setNotification(P\notification("Hello from PHP"))
    ->setDeviceTypes(P\all)
    ->send();
