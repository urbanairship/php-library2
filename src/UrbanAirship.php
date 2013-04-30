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
use \HTTP_Request2;

require_once "RESTClient.php";
require_once "HTTP/Request2.php";

class UAAPIResponse {
    private $responseCode;
    private $responseData;
    private $responsePhrase;

    public function getResponsePhrase() {
        return $this->responsePhrase;
    }

    public function getResponseCode(){
        return $this->responseCode;
    }

    public function getResponseData(){
        return $this->responseData;
    }

    function __construct($http_request2_response) {
        $this->responseCode = $http_request2_response->getStatus();
        $this->responsePhrase = $http_request2_response->getReasonPhrase();
        $this->responseData = json_decode($http_request2_response->getBody());
    }

}

class UrbanAirship{

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
     * @return HTTP_Request2
     */
    public static function getTokenInformation($key, $secret, $token){
        $url = self::appendPathComponentsToURL(self::$BASE_URL, array(
            self::$DEVICE_TOKEN_PATH, $token));
        $request = RESTClient::createBasicAuthRequest(HTTP_Request2::METHOD_GET, $url,
            $key, $secret);
        return $request;
    }


    private static function appendPathComponentsToURL($url, $pathComponents){
        $path = implode(self::$URL_PATH_SEPARATOR, $pathComponents);
        return "{$url}/{$path}/";
    }

    public static function parseServerResponse($response){
        return new UAAPIResponse($response);
    }

}

