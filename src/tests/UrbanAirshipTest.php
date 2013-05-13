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


use Httpful\Http;

require_once __DIR__ . "/../../vendor/autoload.php";

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

        $request = UA::tokenInformationRequest($this->key, $this->secret, $this->token);
//        print_r($request);
        $url = $request->uri;
        $expectedURL =  "https://go.urbanairship.com/api/device_tokens/token/";
        $this->assertTrue(strcmp($expectedURL, $url) == 0);
        $this->assertTrue(strcmp($request->username, $this->key) == 0);
        $this->assertTrue(strcmp($request->password, $this->secret) == 0);
        $this->assertTrue(strcmp($request->method, "GET") == 0);
    }

    public function testGetRegisterDeviceTokenRequest(){

        $request = UA::registerDeviceTokenRequest($this->key, $this->secret, $this->token);
//        print_r($request);
        $url = $request->uri;
        $expectedURL =  "https://go.urbanairship.com/api/device_tokens/token/";
        $this->assertTrue(strcmp($expectedURL, $url) == 0);
        $this->assertTrue(strcmp($request->username, $this->key) == 0);
        $this->assertTrue(strcmp($request->password, $this->secret) == 0);
        $this->assertTrue(strcmp($request->method, "PUT") == 0);
    }



    public function testGetPushMessagingRequest()
    {
        $request = \UrbanAirship\IosApi::getPushMessagingRequest(
            $this->key,
            $this->secret,
            $this->token,
            $this->payload);

        print_r($request);
    }




}
