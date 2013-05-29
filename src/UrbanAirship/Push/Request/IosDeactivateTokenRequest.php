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

use \Httpful\Mime;
use UrbanAirship\Push\Exception\UARequestException;
use UrbanAirship\Push\Log\UALog;
use UrbanAirship\Push\Response\UAResponse;

/**
 * Deactivate the given token with Urban Airship.
 * Class IosDeactivateTokenRequest
 * @package UrbanAirship\Push\Request
 */
class IosDeactivateTokenRequest extends IosRegisterTokenRequest
{

    /**
     * Create a new IosDeactivateTokenRequest.
     * @return IosDeactivateTokenRequest|IosRegisterTokenRequest
     */
    public static function request()
    {
        return new IosDeactivateTokenRequest();
    }

    /**
     * Create the Httpful/Request authenticated with the app key and secret.
     * The HTTP method is DELETE.
     * @return \Httpful\Request
     */
    public function buildHttpRequest()
    {
        $request = parent::buildHttpRequest();
        $request->method(self::DELETE);
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
        $this->log->info("Sending Urban Airship Deactivate token request");
        $this->log->debug(UALog::debugLogForRequest($request));
        return new UAResponse($request->send());
    }
}