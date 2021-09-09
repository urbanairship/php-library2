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
    ->setAudience(P\iosChannel("Insert your iOS channel here!"))
    ->setNotification(P\notification("Hello from PHP"))
    ->setDeviceTypes(P\deviceTypes("ios"))
    ->send();
