#!/usr/local/bin/php
<?php

//    Copyright 2012 Urban Airship
//
//    Licensed under the Apache License, Version 2.0 (the "License");
//    you may not use this file except in compliance with the License.
//    You may obtain a copy of the License at
//
//    http://www.apache.org/licenses/LICENSE-2.0
//
//    Unless required by applicable law or agreed to in writing, software
//    distributed under the License is distributed on an "AS IS" BASIS,
//    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
//    See the License for the specific language governing permissions and
//    limitations under the License.

namespace UrbanAirship;

require_once '../../vendor/autoload.php';

use UrbanAirship\Push\Payload\IosMessagePayload;
use UrbanAirship\Push\Payload\IosRegistrationPayload;
use UrbanAirship\Push\Payload\NotificationPayload;
use UrbanAirship\Push\Request\IosRegisterTokenRequest;
use UrbanAirship\Push\Request\PushNotificationRequest;
use UrbanAirship\Push\Url\IosUrl;
use UrbanAirship\Push\Url\NotificationUrl;


// Setup some data
$reachPushAppKey = "Hx7SIqHqQDmFj6aruaAFcQ";
$reachPushAppSecret = "JkyLL9IqQ2OVkashrzLq-A";
$deviceToken = "1bf62ee6bf92337785c0da1c0ff16c7dbc03b9f4e19b23834a754f19c0e962d9";

// Register a token

$registrationPayload = IosRegistrationPayload::payload();
$registrationPayload->setTags(array("iphone php"))->setAlias("M iphone 4");

// Setup key, secret, payload, and send. Will return a UAResponse with a 2**
// or throw a UARequestException
$registrationResponse = IosRegisterTokenRequest::request()
    ->setAppKey($reachPushAppKey)
    ->setAppSecret($reachPushAppSecret)
    ->setDeviceToken($deviceToken)
    ->setRegistrationPayload($registrationPayload)
    ->send();

print_r($registrationResponse);

// Similar process, setup a message
$apsMessage = IosMessagePayload::payload()
    ->setAlert("PHP Alert for iOS");

// Setup a payload that matches the type of message you want to send, either
// a push, broadcast, or batch
$pushPayload = NotificationPayload::payload()
    ->setAps($apsMessage)
    ->setDeviceTokens(array($deviceToken));

// Pick the URL, this is how the same request object is used for different
// requests safely.
$pushNotificationUrl = NotificationUrl::pushNotificationUrl();

// Build the request by setting params, then send it. It throws an exception
// if there is a non 2** from the server.
$pushNotificationResponse = PushNotificationRequest::request($pushNotificationUrl)
    ->setAppKey($reachPushAppKey)
    ->setAppSecret($reachPushAppSecret)
    ->setPushNotificationPayload($pushPayload)
    ->send();

print_r($pushNotificationResponse);

?>
