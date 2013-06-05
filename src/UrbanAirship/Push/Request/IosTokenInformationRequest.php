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
use Httpful\Mime;

/**
 * Get metadata from the Urban Airship API about this device token.
 * Class IosTokenInformationRequest
 * @package UrbanAirship\Push\Request
 */
class IosTokenInformationRequest extends IosRegisterTokenRequest
{

    /**
     * Set the device token for this request. This is required.
     * @param $deviceToken
     * @return $this
     */
    public function setDeviceToken($deviceToken)
    {
        $this->deviceToken = $deviceToken;
        return $this;
    }

    /**
     * Build a Httpful/Request using the metadata associated with this object.
     * @return \Httpful\Request
     */
    public function buildHttpRequest()
    {
        $request = parent::buildHttpRequest();
        $request->method(self::GET);
        return $request;
    }

    /**
     * Create a IosTokenInformationRequest.
     * @return IosRegisterTokenRequest|IosTokenInformationRequest
     */
    public static function request()
    {
        return new IosTokenInformationRequest();
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
        $this->log->debug(UALog::debugLogForRequest($request));
        return new UAResponse($request->send());
    }


}