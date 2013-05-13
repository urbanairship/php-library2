#!/usr/local/bin/php
<?php

namespace UrbanAirship;

require_once '../../vendor/autoload.php';

use UrbanAirship\IosApi;

$longopts = array (
    "token:",
    "info",
);

$key = "Hx7SIqHqQDmFj6aruaAFcQ";
$secret = "AAZnUxo7QvCHz3SAVb1O3w";
$masterSecret = "JkyLL9IqQ2OVkashrzLq-A";
$token = "9459c465b199f44e8127c9e24e180615bb759e4f46de57f1b73a32d97700e6b9";
$token2 = "1bf62ee6bf92337785c0da1c0ff16c7dbc03b9f4e19b23834a754f19c0e962d9";

$response = IosApi::tokenInformation($key, $secret, $token);
//
//$payload = UrbanAirship::Payloads::IosRegistration::Builder().setAlias().setPayload().build();
//(my fancy stuff





?>
