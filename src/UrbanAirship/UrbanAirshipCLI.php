#!/usr/local/bin/php
<?php

namespace UrbanAirship;

require_once '../../vendor/autoload.php';

use UrbanAirship\Push\Payload\NotificationPayload;

use UrbanAirship\Push\Request\IosRegisterTokenRequest;
use UrbanAirship\Push\Request\IosTokenInformationRequest;
use UrbanAirship\Push\Request\IosDeactivateTokenRequest;
use UrbanAirship\Push\Request\PushNotificationRequest;
use UrbanAirship\Push\Payload\IosMessagePayload;
use UrbanAirship\Push\Url\IosUrl;
use UrbanAirship\Push\Url\NotificationUrl;

$longopts = array (
    "token:",
    "info",
);

$key = "Hx7SIqHqQDmFj6aruaAFcQ";
$secret = "AAZnUxo7QvCHz3SAVb1O3w";
$masterSecret = "JkyLL9IqQ2OVkashrzLq-A";
$token = "9459c465b199f44e8127c9e24e180615bb759e4f46de57f1b73a32d97700e6b9";
$token2 = "1bf62ee6bf92337785c0da1c0ff16c7dbc03b9f4e19b23834a754f19c0e962d9";

//$response = IosRegisterTokenRequest::request()
//    ->setAppKey($key)
//    ->setAppSecret($secret)
//    ->setDeviceToken($token)
//    ->send();
//echo "REGISTER\n";
//print_r($response);

//$response = IosTokenInformationRequest::request()
//    ->setAppKey($key)
//    ->setAppSecret($secret)
//    ->setDeviceToken($token)
//    ->send();
//
//echo "INFO\n";
//print_r($response);

//$response = IosDeactivateTokenRequest::request()
//    ->setAppKey($key)
//    ->setAppSecret($secret)
//    ->setDeviceToken($token)
//    ->send();
//
//echo "DEACTIVATE\n";
//print_r($response);

$aps = IosMessagePayload::payload()
    ->setAlert("Hello from PHP");

$payload = NotificationPayload::payload()
    ->setAps($aps)
    ->setDeviceTokens(array($token, $token2));

//$url = NotificationUrl::pushNotificationUrl();
//$response = PushNotificationRequest::request($url)
//    ->setAppKey($key)
//    ->setAppSecret($masterSecret)
//    ->setPushNotificationPayload($payload)
//    ->send();
//
//print_r($response);

$aps = IosMessagePayload::payload()
    ->setAlert("Hello from PHP");

$payload = NotificationPayload::payload()
    ->setAps($aps)
    ->setDeviceTokens(array($token, $token2));

$url = NotificationUrl::batchNotificationUrl();
$response = PushNotificationRequest::request($url)
    ->setAppKey($key)
    ->setAppSecret($masterSecret)
    ->setPushNotificationPayload(array($payload))
    ->send();

print_r($response);

//$payload = MessagePayload::payload()
//    ->setAps($aps);
//
//$url = NotificationUrl::broadcastNotificationUrl();
//$response = PushNotificationRequest::request($url)
//    ->setAppKey($key)
//    ->setAppSecret($masterSecret)
//    ->setPushNotificationPayload($payload)
//    ->send();
//
//print_r($response);

?>
