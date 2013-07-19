<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use UrbanAirship\UALog;
use Monolog\Handler\NullHandler;

/*UALog::setLogHandlers(array(new StreamHandler("php://stdout", Logger::DEBUG)));*/
UALog::setLogHandlers(array(new NullHandler()));
