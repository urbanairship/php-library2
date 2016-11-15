<?php

require_once 'vendor/autoload.php';

use UrbanAirship\Airship;
use UrbanAirship\UALog;
use UrbanAirship\Push as P;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

UALog::setLogHandlers(array(new StreamHandler("php://stdout", Logger::INFO)));
$airship = new Airship("key", "secret");

// For Channel Lookup
$chan = $airship->channelLookup("Insert your channel here!")
    ->channelInfo();
var_export($chan);

// For Channel Listing
// $chans = $airship->listChannels();
// foreach ($chans as $chan) {
//     var_export($chan);
// }
