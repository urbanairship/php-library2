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

use Httpful\Http;
use Httpful\Mime as Mime;
use Httpful\Request as Request;

require_once $_SERVER["UA_HANGER"].'/vendor/autoload.php';

class UrbanAirshipAPIResponse
{
    private $code;
    private $responseBody;


    /**
     * Response code for the request.
     * @return integer
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Object parsed from JSON response or nil
     * @return object
     */
    public function getResponseBody()
    {
        return $this->responseBody;
    }

    function __construct($httpful_response)
    {
        $this->code = $httpful_response->code;
        # JSON Parsing is free
        $this->responseBody = $httpful_response->body;
    }
}

class UrbanAirshipAPI
{

    /**
     * @var string $BASE_URL The base url for the Urban Airship API
     */
    private static $BASE_URL = "https://go.urbanairship.com/api";

    /**
     * @var string $PUSH_PATH Push path.
     */
    private static $PUSH_PATH = "push";

    private static $DEVICE_TOKEN_PATH = "device_tokens";


    /** @var string $URL_PATH_SEPARATOR Path separator for URLs as strings */
    private static $URL_PATH_SEPARATOR = "/";

    /**
     * @return string Base url for the Urban Airhsip API
     */
    public static function getBaseUrlForUrbanAirshipAPI()
    {
        return self::$BASE_URL;
    }

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
        return self::parseServerResponse($request->send());

    }

    /**
     * Get a request for information about a particular device token.
     * @param $key string Application key
     * @param $secret string Application secret
     * @param $token string Device token to get metadata for
     * @return Request
     */
    public static function getTokenInformationRequest( $key, $secret, $token)
    {
        $url = self::appendPathComponentsToURL(
            self::$BASE_URL,
            array(self::$DEVICE_TOKEN_PATH, $token));

        return self::getBasicAuthRequest($url, $key, $secret);
    }

    /**
     * Get an HTTP Request authenticated with the username and password using
     * basic auth.
     * @param $url string URL for the request
     * @param $username string Username for authentication
     * @param $password string Password for authentication.
     * @return Request
     */
    private static function getBasicAuthRequest($url, $username, $password)
    {
        $request = Request::get($url)->authenticateWithBasic($username, $password);
        return $request;
    }


    /**
     * Create a URL with the given base URL and extra components. The components
     * are appended to the URL using the $PATH
     * @param $url
     * @param $pathComponents
     * @return string
     */
    private static function appendPathComponentsToURL($url, $pathComponents)
    {
        $path = implode(self::$URL_PATH_SEPARATOR, $pathComponents);
        return "{$url}/{$path}/";
    }

    /**
     * Register a device token with Urban Airship.
     *
     * @param $key string App key.
     * @param $secret string App Secret.
     * @param $token string Device Token
     * @return Request
     */
    public static function registerDeviceToken($key, $secret, $token){
        $request = self::getRegisterDeviceTokenRequest($key, $secret, $token);
        return self::parseServerResponse($request->send());

    }


    public static function getRegisterDeviceTokenRequest($key, $secret, $token){
        $request = self::getTokenInformationRequest($key, $secret, $token);
        $request->method = Http::PUT;
        return $request;
    }


    public static function parseServerResponse($response)
    {
        return new UrbanAirshipAPIResponse($response);
    }

}

