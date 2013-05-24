#!/usr/local/bin/php
<?php

namespace UrbanAirship;


require_once '../../vendor/autoload.php';

use UrbanAirship\Push\Payload\IosRegistrationPayload;
use UrbanAirship\Push\Payload\NotificationPayload;

use UrbanAirship\Push\Request\IosRegisterTokenRequest;
use UrbanAirship\Push\Request\IosTokenInformationRequest;
use UrbanAirship\Push\Request\IosDeactivateTokenRequest;
use UrbanAirship\Push\Request\PushNotificationRequest;
use UrbanAirship\Push\Request\IosFeedbackRequest;
use UrbanAirship\Push\Request\IosDeviceTokenListRequest;
use UrbanAirship\Push\Payload\IosMessagePayload;
use UrbanAirship\Push\Url\IosUrl;
use UrbanAirship\Push\Url\NotificationUrl;
use UrbanAirship\UrbanAirshipAPI;
use UrbanAirship\Push\Payload\AndroidMessagePayload;
use UrbanAirship\Push\Payload\BackberryMessagePayload;


$reachPushAppKey = "Hx7SIqHqQDmFj6aruaAFcQ";
$reachPushAppSecret = "JkyLL9IqQ2OVkashrzLq-A";

?>
