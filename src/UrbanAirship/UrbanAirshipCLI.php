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

use Monolog\Logger;

use UrbanAirship\Push\Audience;
use UrbanAirship\Push\Payload\IosMessagePayload;
use UrbanAirship\Push\Payload\IosRegistrationPayload;
use UrbanAirship\Push\Payload\NotificationPayload;
use UrbanAirship\Push\Request\IosRegisterTokenRequest;
use UrbanAirship\Push\Request\PushNotificationRequest;
use UrbanAirship\Push\Url\IosUrl;
use UrbanAirship\Push\Url\NotificationUrl;

use UrbanAirship\Push\Log\UALog;



print_r(Audience::absoluteDate($resolution="days", $start="now", $end="later", $lastSeen=true));


//// Setup some data
//$reachPushAppKey = "pvNYHR9ZSGGk1LwuPl4kqw";
//$reachPushAppSecret = "fTyEFfyTR-a40Bxcmv9vEg";
//$testDeviceToken = "254dacf1cc805018dff630d164d7ac4cdfd8ce14b4e66d96132d84bb16e93abc
//
//// Setup some logging. Default is a stream handler. We use the Monolog library,
//// which is PRS-3 compliant, so any logging framework that complies with the standard
//// could be used. Read more about the FIG standards here:
//// https://github.com/php-fig/fig-standards
//
//UALog::setLogHandlers(array(new StreamHandler("php://stdout", Logger::DEBUG)));
//$log = UALog::getLogger();
//
//// Set up your key and secret for the Urban Airship API
//$appKey = $reachPushAppKey;
//$appMasterSecret = $reachPushAppSecret;
//
//// The library supports all of the push types for Urban Airship, push notifications,
//// broadcast notifications, and batch. This example utilizes the push notification, which
//// sends a notification to a list of tokens.
//$deviceToken = $testDeviceToken;
//
//// Build a message payload with the necessary data for your notification. The library supports
//// iOS, Android, and Blackberry.
//$apsMessage = IosMessagePayload::payload()
//    ->setAlert("Push Message")
//    ->setBadge(1)
//    ->setSound("customSound.caf");
//
//// Setup a payload that matches the type of message you want to send, either
//// a push, broadcast, or batch. See the Urban Airship documentation for payload formatting.
//$pushPayload = NotificationPayload::payload()
//    ->setDeviceTokens($deviceToken);
//
//// Create a request, set up authentication and payload, and send it. The response is wrapped and
//// returned. Logging is built in, and uses the logger you provide.
//$pushNotificationResponse = PushNotificationRequest::request()
//    ->setAppKey($appKey)
//    ->setAppSecret($appMasterSecret)gi
//    ->setPushNotificationPayload($pushPayload)
//    ->send();
//
//// Check the response for errors
//if ($pushNotificationResponse->hasErrors()) {
//    $log->error("Push notification didn't work");
//}
//else {
//    $log->debug("Push message succeeded");
//}

