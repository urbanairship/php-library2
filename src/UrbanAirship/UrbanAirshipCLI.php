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
$masterSecret = "JkyLL9IqQ2OVkashrzLq-A";
$token = "9459c465b199f44e8127c9e24e180615bb759e4f46de57f1b73a32d97700e6b9";
$token2 = "1bf62ee6bf92337785c0da1c0ff16c7dbc03b9f4e19b23834a754f19c0e962d9";

//$response = UrbanAirshipAPI::getTokenInformation($key, $secret, $token);
//
//$payload = new UrbanAirshipIosRegistrationPayload();
//$payload->setAlias("PHP")->setTags(array("php rocks"));
//$response = UrbanAirshipAPI::registerDeviceToken($key, $secret, $token2, $payload);
//
//print_r($response);
//
//print_r(UrbanAirshipAPI::getTokenInformation($key, $secret, $token2));

$aps = UrbanAirshipAPI::getApsPayload()
    ->setAlert("PHP Alert")
    ->setSound("cat.caf");

$messagePayload = UrbanAirshipAPI::getPushMessagePayload()
    ->setAps($aps)
    ->setDeviceTokens(array($token, $token2));

$response = UrbanAirshipAPI::sendPushMessage($key, $masterSecret, $messagePayload);
print_r($response);
//$request = UrbanAirshipAPI::getPushMessagingRequest($key, $masterSecret)
//print_r(json_encode($aps));



?>
