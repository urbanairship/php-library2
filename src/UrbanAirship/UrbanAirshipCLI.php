#!/usr/local/bin/php
<?php

namespace UrbanAirship;

require_once '../../vendor/autoload.php';

use UrbanAirship\Push\Payload\IosMessagePayload;
use UrbanAirship\Push\Payload\IosRegistrationPayload;
use UrbanAirship\Push\Payload\NotificationPayload;
use UrbanAirship\UrbanAirshipAPI;


// Setup some data
$reachPushAppKey = "Hx7SIqHqQDmFj6aruaAFcQ";
$reachPushAppSecret = "JkyLL9IqQ2OVkashrzLq-A";
$deviceToken = "1bf62ee6bf92337785c0da1c0ff16c7dbc03b9f4e19b23834a754f19c0e962d9";

// Get an API object, set authentication and app data on the object
$api = new UrbanAirshipAPI();
$api->setAppKey($reachPushAppKey)->setAppMasterSecret($reachPushAppSecret);

//// Setup a data payload
//$registration = new IosRegistrationPayload();
//$registration->setTags(array("tag from php"));
//
//// Execute, and catch errors
//print_r($api->registerDeviceToken($deviceToken, $registration));

// Build APS payload
$pushMessage = IosMessagePayload::payload();
$pushMessage->setAlert("PHP Alert");

// Make notification payload
$pushNotification = new NotificationPayload();
$pushNotification
    ->setAps($pushMessage)
    ->setDeviceTokens(array($deviceToken));

// Make send request
print_r($api->sendPushNotification($pushNotification));




?>
