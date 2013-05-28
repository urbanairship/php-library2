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
use UrbanAirship\Push\Response\UAResponse;
use UrbanAirship\Push\Url\IosUrl;
use Httpful\Mime;

/**
 * Query the Urban Airship feedback service for a list of tokens that have
 * been returned by Apple as uninstalled or have been rendered inactive through
 * the API.
 * Class IosFeedbackRequest
 * @package UrbanAirship\Push\Request
 */
class IosFeedbackRequest extends UARequest
{

    /**
     * @var \DateTime Date for feedback request.
     */
    private $dateTime;

    /**
     * A Date object that defines how far back the feedback query should
     * go.
     * @param $dateTime \DateTime Date for the feedback request
     * @return $this
     */
    public function setDateTime(\DateTime $dateTime)
    {
        $this->dateTime = $dateTime;
        return $this;
    }

    /**
     * Creates a new IosFeedbackRequest.
     * @return IosFeedbackRequest
     */
    public static function request()
    {
        return new IosFeedbackRequest();
    }

    /**
     * Returns an request for device tokens reported in the feedback service.
     * If the date exceeds available feedback, the request will return a 400.
     * @return \Httpful\Request
     */
    public function buildHttpRequest()
    {
        $timestamp = $this->dateTime->getTimestamp();
        $url = IosUrl::iosFeedbackSince(date(DATE_ISO8601, $timestamp));
        $request = $this->basicAuthRequest($url);
        return $request;
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
        return new UAResponse($request->send());
    }

}