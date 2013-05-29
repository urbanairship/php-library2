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

namespace UrbanAirship\Push\Request;

use UrbanAirship\Push\Exception\UARequestException;
use UrbanAirship\Push\Log\UALog;
use UrbanAirship\Push\Response\UAResponse;

class PushNotificationRequest extends NotificationRequest
{

    /**
     * @param $url string URL to send the message to, push, batch, or broadcast
     */
    protected  function __construct($url)
    {
        parent::__construct();
        $this->url = $url;
    }

    /**
     * Payloads for push notification. See API documentation for payload options
     * and formats.
     * @param $payload object Array with the correct parameters for the given
     * push URL. Improperly formatted payloads will result in a 400 response
     * @return $this
     */
    public function setPushNotificationPayload($payload)
    {
        $this->log->debug(sprintf("Set push notification payload %s", json_encode($payload, JSON_PRETTY_PRINT)));
        $this->setPayload($payload);
        return $this;
    }

    /**
     * @param $url string URL for the push notification endpoint, either push,
     * batch, or broadcast.
     * @return PushNotificationRequest
     */
    public static function request($url)
    {
        return new PushNotificationRequest($url);
    }

    /**
     * Send the request. This will return a UAResponse on any 200, or throw
     * a UARequestException.
     * @throws UARequestException
     * @return UAResponse
     */
    public function send()
    {
        $request = $this->buildHttpRequest();
        $this->log->info("Sending UrbanAirship Registration request");
        $this->log->debug(UALog::debugLogForRequest($request));
        return new UAResponse($request->send());
    }
}