#!/usr/local/bin/php
<?php

namespace UrbanAirship;

# TODO Figure out another way to setup path to things
require_once '../../vendor/autoload.php';

$longopts = array (
    "token:",
    "info",
);

$key = "Hx7SIqHqQDmFj6aruaAFcQ";
$secret = "AAZnUxo7QvCHz3SAVb1O3w";
$token = "9459c465b199f44e8127c9e24e180615bb759e4f46de57f1b73a32d97700e6b9";

//$response = UrbanAirshipAPI::getTokenInformation($key, $secret, $token);

$response = UrbanAirshipAPI::registerDeviceToken($key, $secret, $token);

print_r($response);



?>
