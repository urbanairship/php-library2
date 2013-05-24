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


//$appKey = "oQ5QAJwuR6eO2CBjyrW3Ng";
//$appSecret = "LZe4cMyhTFaRDWV1mv6H8w";
//
// Master secret
//$appKey = "Hx7SIqHqQDmFj6aruaAFcQ";
//$appSecret = "JkyLL9IqQ2OVkashrzLq-A";
$msAppKey = "oQ5QAJwuR6eO2CBjyrW3Ng";
$msAppSecret = "LZe4cMyhTFaRDWV1mv6H8w";
// app secret
//$appSecret = "AAZnUxo7QvCHz3SAVb1O3w"; // this returns empty array
$request = IosDeviceTokenListRequest::request()->setAppKey($msAppKey)->setAppSecret($msAppSecret);
$response = $request->send();
$body = $response->getResponseBody();
//print_r($body->{'device_tokens'});
foreach ($response as $deviceToken){
    print "TOKEN\n";
    print_r($deviceToken);
    print "\n";
}

//$masterSecret = "JkyLL9IqQ2OVkashrzLq-A";
//$token = "9459c465b199f44e8127c9e24e180615bb759e4f46de57f1b73a32d97700e6b9";
//$token2 = "1bf62ee6bf92337785c0da1c0ff16c7dbc03b9f4e19b23834a754f19c0e962d9";
//
//
//$eAppKey = "_JHWuivGSz-7A0PNaQm1NQ";
//$eAppSecret = "34ajVQNyROeq3AYes3XsJg";
//$eAppMasterSecret = "m-gRrQuGRZ-FOCxwTid-4Q";
//
//$eonlineApid = "ed38ccb9-3059-419f-ba59-1533207b8bc1";
//
//$bbAppKey = "Ig0hGw0oS-u8IXJCuR06QQ";
//$bbAppSecret = "iOP4FY6SSuaLAu6RyQZggg";
//$bbAppMasterSecret = "bp_9LZ8bQZqTkoLZJWWsNw";
//
//$bbNotf = BackberryMessagePayload::payload()
//    ->setContentType("text/plain")
//    ->setBody("BB Rulezz PHP!");



//$androidMessage = AndroidMessagePayload::payload()
//    ->setAlert("PHP Android")
//    ->setExtra("Extra Stuff");
//
//$notificationPayload = NotificationPayload::payload()
//    ->setAndroid($androidMessage)->setApids(array($eonlineApid));
//
//
//print_r(json_encode($bbNotf));
//$url = NotificationUrl::broadcastNotificationUrl();
//$notificationRequest = PushNotificationRequest::request($url)
//    ->setAppKey($eAppKey)
//    ->setAppSecret($eAppMasterSecret)
//    ->setPushNotificationPayload($bbNotf);
//
//print_r($notificationRequest->send());


//$payload = new IosRegistrationPayload();
//$payload->setAlias("phpAlias");
//
//$ios = new UrbanAirshipAPI();
//$ios->setAppKey($key);
//$ios->setAppSecret($secret);
//$response = $ios->registerDeviceToken($token, $payload);
//print_r($response);
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
