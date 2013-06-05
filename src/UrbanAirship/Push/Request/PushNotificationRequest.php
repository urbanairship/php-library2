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
use UrbanAirship\Push\Url\IosUrl;
use UrbanAirship\Push\Url\NotificationUrl;

use Httpful\Mime;
use Httpful\Request;

class PushNotificationRequest extends UARequest
{

    /**
     * @var bool Determines whether this is a broadcast or push notification.
     */
    private $isBroadcast;


    protected function  __construct()
    {
        parent::__construct();
        $this->isBroadcast = false;
    }

    /**
     * Identifies this request as a broadcast notification. Broadcasts are sent
     * to all devices for an application. Push notifications require a list, or
     * lists of device identifiers (apids|device id's|device tokens)
     * @param $isBroadcast
     * @return $this
     */
    public function setIsBroadcast($isBroadcast)
    {
        $this->isBroadcast = $isBroadcast;
        return $this;
    }

    /**
     * Status of the isBroadcast
     * @return bool
     */
    public function getIsBroadcast()
    {
        return $this->isBroadcast;
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
     * Build a request with the given parameters.
     * @return PushNotificationRequest
     */
    public static function request()
    {
        return new PushNotificationRequest();
    }

    /**
     * Build a Httpful\Request with the parameters set on this object.
     * @return Request|mixed
     */
    public function buildHttpRequest()
    {
        if ($this->isBroadcast){
            $url = NotificationUrl::broadcastNotificationUrl();
        }
        else {
            $url = NotificationUrl::pushNotificationUrl();
        }

        $request = self::basicAuthRequest($url)
            ->method(self::POST)
            ->sendsType(Mime::JSON)
            ->body(json_encode($this->payload));
        return $request;
    }

    /**
     * Send the request. This will return a UAResponse.
     * @throws UARequestException
     * @return UAResponse
     */
    public function send()
    {
        $request = $this->buildHttpRequest();
        $this->log->debug(UALog::debugLogForRequest($request));
        return new UAResponse($request->send());
    }
}