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

use UrbanAirship\RESTClient as RClient;
use UrbanAirship\UrbanAirship as UA;

require_once __DIR__ . "/../UrbanAirship.php";
require_once __DIR__ ."/../RESTClient.php";
require_once "HTTP/Request2.php";

class TestRestClient  extends PHPUnit_Framework_TestCase{

    public function testBasicAuthRequest(){
        $url = "url";
        $user = "user";
        $pass = "pass";
        $request = RClient::createBasicAuthRequest(HTTP_Request2::METHOD_GET,
            $url,
            $user,
            $pass);

        $this->assertTrue(strcmp($request->getUrl(), $url) == 0);
        $auth_headers = $request->getAuth();
//        print_r($auth_headers);
        $this->assertTrue(strcmp($auth_headers['user'], $user) == 0);
        $this->assertTrue(strcmp($auth_headers['password'], $pass) == 0);
        $this->assertTrue(strcmp($auth_headers['scheme'],
            HTTP_Request2::AUTH_BASIC ) == 0);
    }



}

class TestUrbanAirship extends PHPUnit_Framework_TestCase {

    public function testGetTokenInformationRequest(){
        $key = "key";
        $secret = "secret";
        $token = "token";
        $request = UA::getTokenInformation($key, $secret, $token);
        $url = $request->getUrl();
        $expectedURL =  "https://go.urbanairship.com/api/device_tokens/token/";
        $this->assertTrue(strcmp($expectedURL, $url) == 0);
    }
}
