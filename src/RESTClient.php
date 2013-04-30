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

//require_once "HTTP/Request2.php";

/**
 * Class RESTClient is a lightweight wrapper around HTTP_Request2 for use with
 * the Urban Airship API

 *
 * @package UrbanAirship
 * @author Matt Hooge <mhooge@urbanairhsip.com>
 */
 class RESTClient {

    /**
     * Create a authenticated request with the given parameters for use with the
     * Urban Airship API.
     *
     * @param string $method REST method for the request. Use the methods defined in
     * HTTP_Request2. Example: HTTP_Request2::METHOD_GET
     * @param string $url The URL for the request.
     * @param string $key The app key for the request.
     * @param string $secret The secret used to authenticate the request. Depending on
     * access level needed, the could be the app secret or app master secret.
     * @return HTTP_Request2
     */
    public static function createBasicAuthRequest($method, $url, $key, $secret){
        $request = new HTTP_Request2($url);
        $request->setMethod($method);
        // Defaults to basic auth, which is what we're looking for
        $request->setAuth($key, $secret);
        return $request;
    }











}