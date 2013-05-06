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

use UrbanAirship\UrbanAirshipAPI as UA;
use UrbanAirship\UrbanAirshipPushPayload as PushPayload;
use UrbanAirship\UrbanAirshipIosRegistrationPayload as RegistrationPayload;

use Httpful\Http;

require_once $_SERVER["UA_HANGER"] . "/src/UrbanAirship/UrbanAirshipAPI.php";
require_once $_SERVER["UA_HANGER"] . "/src/UrbanAirship/UrbanAirshipRequest.php";
require_once $_SERVER["UA_HANGER"] . "/src/UrbanAirship/UrbanAirshipPushPayload.php";
require_once $_SERVER["UA_HANGER"] . "/src/UrbanAirship/UrbanAirshipIosRegistrationPayload.php";
require_once $_SERVER["UA_HANGER"] . "/src/UrbanAirship/UrbanAirshipIosPushMessage.php";

class TestUrbanAirship extends PHPUnit_Framework_TestCase {

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

    public function testGetTokenInformationRequest()
    {

        $request = UA::getTokenInformationRequest($this->key, $this->secret, $this->token);
//        print_r($request);
        $url = $request->uri;
        $expectedURL =  "https://go.urbanairship.com/api/device_tokens/token/";
        $this->assertTrue(strcmp($expectedURL, $url) == 0);
        $this->assertTrue(strcmp($request->username, $this->key) == 0);
        $this->assertTrue(strcmp($request->password, $this->secret) == 0);
        $this->assertTrue(strcmp($request->method, "GET") == 0);
    }

    public function testGetRegisterDeviceTokenRequest(){

        $request = UA::getRegisterDeviceTokenRequest($this->key, $this->secret, $this->token);
//        print_r($request);
        $url = $request->uri;
        $expectedURL =  "https://go.urbanairship.com/api/device_tokens/token/";
        $this->assertTrue(strcmp($expectedURL, $url) == 0);
        $this->assertTrue(strcmp($request->username, $this->key) == 0);
        $this->assertTrue(strcmp($request->password, $this->secret) == 0);
        $this->assertTrue(strcmp($request->method, "PUT") == 0);
    }

    public function testUrbanAirshipPushPayload()
    {
        //TODO setup aps payload
        $payload = new PushPayload();
        $aps = new \UrbanAirship\UrbanAirshipApsPayload(
            "siren",
            4,
            "cat.caf");
        $payload->setAps($aps);
        $payload->setDeviceTokens(array("token"));
        $payload->setTags(array("tag"));
        $payload->setAliases(array("alias"));
        $json = json_encode($payload, JSON_PRETTY_PRINT);
        print_r($json);
    }

    public function testUrbanAirshipIosRegistrationPayload()
    {
        $payload = new RegistrationPayload();
        $payload->setAlias("alias");
        $payload->setBadge(1);
        $payload->setQuietTime("qt_start", "qt_end");
        $payload->setTimeZone("pancake_time");
//        print_r(json_encode($payload, JSON_PRETTY_PRINT));

    }

//    public function testGetPushMessagingRequest()
//    {
//        $request = \UrbanAirship\UrbanAirshipAPI::getPushMessagingRequest(
//            $this->key,
//            $this->secret,
//            $this->token,
//            $this->payload);
//
//        print_r($request);
//    }

//    public function testPushMessage()
//    {
//        $message = new \UrbanAirship\UrbanAirshipIosPushMessage();
//        $message->setAlert("alert")->setBadge(1)->setDeviceTokens("token")->setAliases("cats");
//        print_r(json_encode($message, JSON_PRETTY_PRINT));
//
//    }




}
