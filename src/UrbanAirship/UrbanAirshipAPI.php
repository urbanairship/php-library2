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

/**
 * Urban Airship PHP API Library
 */
namespace UrbanAirship;

use Httpful\Mime as Mime;
use Httpful\Request as Request;

require_once $_SERVER["UA_HANGER"].'/vendor/autoload.php';

class UrbanAirshipAPIResponse
{
    private $responseCode;
    private $responseData;
    private $responsePhrase;

    /**
     * Response phrase for HTTP request ( OK, Unauthorized, Not found.....)
     * @return string
     */
    public function getResponsePhrase()
    {
        return $this->responsePhrase;
    }

    /**
     * Response code for the request.
     * @return integer
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }

    /**
     * Object parse from JSON response or nil
     * @return object
     */
    public function getResponseData()
    {
        return $this->responseData;
    }

    function __construct($http_request2_response)
    {
        $this->responseCode = $http_request2_response->getStatus();
        $this->responsePhrase = $http_request2_response->getReasonPhrase();
        $this->responseData = json_decode($http_request2_response->getBody());
    }

}

class UrbanAirshipAPI
{

    /**
     * @var string $BASE_URL The base url for the Urban Airship API
     */
    private static $BASE_URL = "https://go.urbanairship.com/api";

    private static $PUSH_PATH = "push";

    private static $DEVICE_TOKEN_PATH = "device_tokens";

    /** @var string $URL_PATH_SEPARATOR Path separator for URLs as strings */
    private static $URL_PATH_SEPARATOR = "/";

    /**
     * Retrieve metadata about an iOS device from the UA API
     * @param string $key Application key
     * @param string $secret Application secret
     * @param string $token iOS device token
     * @return Httpful\Request
     */
    public static function getTokenInformation($key, $secret, $token)
    {
        $request = self::getTokenInformationRequest($key, $secret, $token);
        $response = $request->send();
        return $response;
    }

    public static function getTokenInformationRequest( $key, $secret, $token)
    {
        $url = self::appendPathComponentsToURL(
            self::$BASE_URL,
            array(self::$PUSH_PATH, self::$DEVICE_TOKEN_PATH),
            $token);

        return self::getBasicAuthRequest($url, $key, $secret);
    }

    private static function getBasicAuthRequest($url, $username, $password)
    {
        $request = Request::get($url)->authenticateWithBasic($username, $password);
        return $request;
    }


    private static function appendPathComponentsToURL($url, $pathComponents)
    {
        $path = implode(self::$URL_PATH_SEPARATOR, $pathComponents);
        return "{$url}/{$path}/";
    }

    public static function parseServerResponse($response)
    {
        return new UrbanAirshipAPIResponse($response);
    }

}

