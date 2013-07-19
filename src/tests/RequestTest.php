<?php
/*
Copyright 2013 Urban Airship and Contributors
*/

use Httpful\Http;

require_once __DIR__ . "/../../vendor/autoload.php";

use UrbanAirship\Push\Payload;

use UrbanAirship\Push\Request\IosRegisterTokenRequest;
use UrbanAirship\Push\Request\IosTokenInformationRequest;
use UrbanAirship\Push\Request\IosDeactivateTokenRequest;
use UrbanAirship\Push\Request\IosFeedbackRequest;

use UrbanAirship\Push\Request\PushNotificationRequest;
use UrbanAirship\Push\Request\BatchPushNotificationRequest;


use UrbanAirship\Push\Url\NotificationUrl;

use Httpful\Request;

class TestRequests extends PHPUnit_Framework_TestCase
{

    protected $key;
    protected $secret;
    protected $token;
    protected $payload;

    protected function setUp()
    {
        $this->key = "key";
        $this->secret = "secret";
        $this->token = "token";
        $this->payload = array("payload" => "stuff");
    }

    public function testTokenInformationRequest()
    {
        $infoRequest = IosTokenInformationRequest::request()
            ->setAppKey($this->key)
            ->setAppSecret($this->secret)
            ->setDeviceToken($this->token);
        $request = $infoRequest->buildHttpRequest();
        $expectedURL =  "https://go.urbanairship.com/api/device_tokens/token/";
        $this->assertTrue(strcmp($expectedURL, $request->uri) == 0, "bad url");
        $this->assertTrue(strcmp($request->username, $this->key) == 0, "bad key");
        $this->assertTrue(strcmp($request->password, $this->secret) == 0, "bad secret");
        $this->assertTrue(strcmp($request->method, "GET") == 0, "wrong http method");
    }

    public function testIosRegisterTokenRequest(){

        $registrationRequest = IosRegisterTokenRequest::request()
            ->setAppKey($this->key)
            ->setAppSecret($this->secret)
            ->setDeviceToken($this->token);

        $request = $registrationRequest->buildHttpRequest();
        $expectedURL =  "https://go.urbanairship.com/api/device_tokens/token/";
        $this->assertTrue(strcmp($expectedURL, $request->uri) == 0, "bad url");
        $this->assertTrue(strcmp($request->username, $this->key) == 0, "bad username");
        $this->assertTrue(strcmp($request->password, $this->secret) == 0, "bad secret");
        $this->assertTrue(strcmp($request->method, "PUT") == 0, "wrong http method");

        $registrationRequest = IosRegisterTokenRequest::request()
            ->setAppKey($this->key)
            ->setAppSecret($this->secret)
            ->setDeviceToken($this->token)
            ->setRegistrationPayload(json_encode(array("key" => "value")));

        $request = $registrationRequest->buildHttpRequest();
        $this->assertTrue($request->content_type === "application/json");

    }


    public function testDeactivateTokenRequest()
    {
        $deactivateRequest = IosDeactivateTokenRequest::request()
            ->setAppKey($this->key)
            ->setAppSecret($this->secret)
            ->setDeviceToken($this->token);

        $request = $deactivateRequest->buildHttpRequest();
        $expectedURL =  "https://go.urbanairship.com/api/device_tokens/token/";
        $this->assertTrue(strcmp($expectedURL, $request->uri) == 0, "bad url");
        $this->assertTrue(strcmp($request->username, $this->key) == 0, "bad username");
        $this->assertTrue(strcmp($request->password, $this->secret) == 0, "bad secret");
        $this->assertTrue(strcmp($request->method, "DELETE") == 0, "wrong http method");

    }

    public function testPushNotificationRequest()
    {

        $testAlert = "The cake is a lie.";
        $aps = Payload\IosMessagePayload::payload()->setAlert($testAlert);
        $testTokens = array("token", "chicken");
        $payload = Payload\NotificationPayload::payload()
            ->setAps($aps)
            ->setDeviceTokens($testTokens);
        $notificationRequest = PushNotificationRequest::request()
            ->setAppKey($this->key)
            ->setAppSecret($this->secret)
            ->setPushNotificationPayload($payload);

        $request = $notificationRequest->buildHttpRequest();
        $this->assertTrue($request->content_type === "application/json");
        $expectedURL = "https://go.urbanairship.com/api/push/";
        $this->assertTrue(strcmp($expectedURL, $request->uri) == 0, "bad push url");
        $this->assertTrue(strcmp($request->username, $this->key) == 0, "bad username");
        $this->assertTrue(strcmp($request->password, $this->secret) == 0, "bad secret");
        $this->assertTrue(strcmp($request->method, "POST") == 0, "wrong http method");
        // Payload checking
        $requestPayload = json_decode($request->payload);
        $this->assertTrue(strcmp($requestPayload->aps->alert, $testAlert) == 0, "wrong alert string" );
        $tokensArray = $requestPayload->device_tokens;
        $this->assertTrue($tokensArray == $testTokens);

        // Test broadcast vs. push URL
        $notificationRequest->setIsBroadcast(true);
        $request = $notificationRequest->buildHttpRequest();
        $expectedURL = "https://go.urbanairship.com/api/push/broadcast/";
        $this->assertTrue($request->uri === $expectedURL, "bad broadcast url");


    }

    public function testFeedbackRequest()
    {
        $date = new DateTime();
        $feedbackRequest = IosFeedbackRequest::request()->setDateTime($date);
        $request = $feedbackRequest->buildHttpRequest();
        $dateString = date(DATE_ISO8601, $date->getTimestamp());
        $expectedUrl = "https://go.urbanairship.com/api/device_tokens/feedback/?since={$dateString}/";
        $this->assertTrue($expectedUrl === $request->uri, "URL for feedback incorrect");
        $this->assertTrue("GET" === $request->method, "Feedback request method incorrect");

    }

    public function testBatchRequest()
    {
        $alert1 = "alert1";
        $alert2 = "alert2";

        $iosMessage1 = Payload\IosMessagePayload::payload()->setAlert($alert1);
        $iosMessage2 = Payload\IosMessagePayload::payload()->setAlert($alert2);
        $notif1 = Payload\NotificationPayload::payload()
            ->setAps($iosMessage1)
            ->setDeviceTokens(array("tokens1"));
        $notif2 = Payload\NotificationPayload::payload()
            ->setAps($iosMessage2)
            ->setDeviceTokens(array("tokens2"));

        $request1 = BatchPushNotificationRequest::request()
            ->appendNotificationToBatch($notif1)
            ->appendNotificationToBatch($notif2);
        $httpRequest = $request1->buildHttpRequest();

        $this->assertTrue($httpRequest->uri === "https://go.urbanairship.com/api/push/batch/");
        $jsonPayload = json_decode($httpRequest->payload);
        print_r($jsonPayload);
        $this->assertTrue(is_array($jsonPayload));
        $jsonMessage1 = $jsonPayload[0];
        $this->assertTrue($jsonMessage1->aps->alert === "alert1");
        $jsonMessage2 = $jsonPayload[1];
        $this->assertTrue($jsonMessage2->aps->alert === "alert2");


    }


}
