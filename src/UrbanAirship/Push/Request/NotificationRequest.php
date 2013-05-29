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

use Httpful\Request;
use Httpful\Mime;
use UrbanAirship\Push\Log\UALog;

/**
 * Base class for Notification Requests against the Urban Airship API.
 * Contains a logger, and a method to build a basic auth HTTP request that can
 * be customized per notification.
 * Class NotificationRequest
 * @package UrbanAirship\Push\Request
 */
abstract class NotificationRequest extends UARequest
{
    /**
     * @var URL for request
     */
    protected $url;

    /**
     * @var \Monolog\Logger Logger for request
     */
    protected $log;

    protected function  __construct()
    {
        $this->log = UALog::getLogger();
    }

    /**
     * Build a HTTP request authenticated with the app key and app master
     * secret, JSON encoded payload, and HTTP PUT as the method.
     * @return Request|mixed
     */
    public function buildHttpRequest()
    {
        $request = self::basicAuthRequest($this->url)
            ->method(self::POST)
            ->sendsType(Mime::JSON)
            ->body(json_encode($this->payload));
        return $request;
    }



}