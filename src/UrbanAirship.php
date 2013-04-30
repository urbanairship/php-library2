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


class UrbanAirship{

    /**
     * @var string $BASE_URL The base url for the Urban Airship API
     */
    private static $BASE_URL = "https://go.urbanairship.com/api";

    private static $PUSH_PATH = "push";

    private static $DEVICE_TOKEN_PATH = "device_tokens";

    /** @var string $URL_PATH_SEPARATOR Path separator for URLs as strings */
    private static $URL_PATH_SEPARATOR = "/";

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

}

