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

use \Boris\Boris;
use \Boris\Inspector;

class MyInspector implements Inspector {

    public function inspect($variable) {
        ob_start();

       print_r($variable);

        return trim(ob_get_clean());

    }

}

$key = "Hx7SIqHqQDmFj6aruaAFcQ";
$secret = "AAZnUxo7QvCHz3SAVb1O3w";
$masterSecret = "JkyLL9IqQ2OVkashrzLq-A";
$token = "9459c465b199f44e8127c9e24e180615bb759e4f46de57f1b73a32d97700e6b9";
$token2 = "1bf62ee6bf92337785c0da1c0ff16c7dbc03b9f4e19b23834a754f19c0e962d9";


$payload = new IosRegistrationPayload();
$payload->setAlias("phpAlias");

$ios = new UrbanAirshipAPI();
$ios->setAppKey($key);
$ios->setAppSecret($secret);
$response = $ios->registerDeviceToken($token, $payload);
print_r($response);
//$ios->setAppKey($key);
//$ios->setAppSecret($masterSecret);

//$boris = new Boris("ua>");
//$boris->setLocal("ios", $ios);
//$boris->setInspector(new MyInspector());
//$boris->start();
//$request = IosDeviceTokenListRequest::request()
//    ->setAppKey("oQ5QAJwuR6eO2CBjyrW3Ng")
//    ->setAppSecret("LZe4cMyhTFaRDWV1mv6H8w");
//
//$response  =$request->send();



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


//$response = IosDeactivateTokenRequest::request()
//    ->setAppKey($key)
//    ->setAppSecret($secret)
//    ->setDeviceToken($token)
//    ->send();
//
//echo "DEACTIVATE\n";
//print_r($response);

//$aps = IosMessagePayload::payload()
//    ->setAlert("Hello from PHP");
//
//$payload = NotificationPayload::payload()
//    ->setAps($aps)
//    ->setDeviceTokens(array($token, $token2));

//$url = NotificationUrl::pushNotificationUrl();
//$response = PushNotificationRequest::request($url)
//    ->setAppKey($key)
//    ->setAppSecret($masterSecret)
//    ->setPushNotificationPayload($payload)
//    ->send();
//
//print_r($response);

//$aps = IosMessagePayload::payload()
//    ->setAlert("Hello from PHP");
//
//$payload = NotificationPayload::payload()
//    ->setAps($aps)
//    ->setDeviceTokens(array($token, $token2));
//
//$url = NotificationUrl::batchNotificationUrl();
//$response = PushNotificationRequest::request($url)
//    ->setAppKey($key)
//    ->setAppSecret($masterSecret)
//    ->setPushNotificationPayload(array($payload))
//    ->send();
//
//print_r($response);

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
