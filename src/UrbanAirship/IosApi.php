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

//TODO add a UA metadata interface for the metadata() function
/**
 * Urban Airship PHP API Library
 */
namespace UrbanAirship;

use UrbanAirship\Request\Registration\Ios as RegistrationReqeust;
use UrbanAirship\Push\Payload\Registration\Ios as RegistrationPayload;

/* require_once $_SERVER["UA_HANGER"].'/vendor/autoload.php'; */

class IosApi
{

    /**
     * Retrieve metadata about an iOS device from the UA API
     * @param string $key Application key
     * @param string $secret Application secret
     * @param string $token iOS device token
     * @return Http/Response
     */
    public static function tokenInformation($key, $secret, $token)
    {


    }

    /**
     * Send a push message to the Urban Airship API
     * @param $key
     * @param $masterSecret
     * @param $pushMessage
     * @return Http/Response
     */

    public static function sendPushMessage($key, $masterSecret, $pushMessage)
    {

    }

    public static function registrationPayload()
    {
        return new RegistrationPayload();
    }

 
    /**
     * Get an authenticated request to register a device
     * @param $key string Application key
     * @param $secret string Application secret
     * @param $token string Device token to register
     * @param Ios $payload Metadata associated
     * with the registration
     * @return Http/Response
     */
   public static function registerDeviceToken($key, $secret, $token, $payload=null)
    {

    }

}

