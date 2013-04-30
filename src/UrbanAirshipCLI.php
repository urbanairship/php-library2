#!/usr/local/bin/php
<?php

use UrbanAirship\UrbanAirship as UA;

require_once "UrbanAirship.php";

$key = "Hx7SIqHqQDmFj6aruaAFcQ";
$secret = "AAZnUxo7QvCHz3SAVb1O3w";
$token = "9459c465b199f44e8127c9e24e180615bb759e4f46de57f1b73a32d97700e6b9";

$request = UA::getTokenInformation($key, $secret, $token);
$response = $request->send();
//print_r($response);
$parsed_response = UA::parseServerResponse($response);
print_r($parsed_response);

?>
