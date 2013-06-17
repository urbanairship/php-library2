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

require_once __DIR__ . "/../../vendor/autoload.php";

use Httpful\Request;
use Httpful\Response;

use UrbanAirship\Push\Response\UAResponse;


class TestResponse extends PHPUnit_Framework_TestCase
{

    public function testUAResponse()
    {
        $request = Request::get("http://www.google.com");
        $goodResponseHeaders = "Status: 200 OK\r\n\r\n";
        $goodResponseBody = "OK";

        $goodResponse = new Response($goodResponseBody, $goodResponseHeaders, $request);
        $testResponse = new UAResponse($goodResponse);
        $this->assertTrue($testResponse->getResponseCode() === 200,
            "Bad response code in UAResponse");
        $this->assertTrue($testResponse->getResponseBody() === $goodResponseBody,
            "Bad response body in UAResponse");

    }


    public function testUAResponseThrowsException()
    {
        $request = Request::get("http://www.google.com");

        $badResponseHeaders = "Status: 400 Bad Request\r\n\r\n";
        $badResponseBody = "Bad Request";
        $badResponse = new Response($badResponseBody, $badResponseHeaders, $request);
        $response = new UAResponse($badResponse);
        $this->assertTrue($response->hasErrors());
        $this->assertTrue($response->getResponseCode() === 400);
    }
}