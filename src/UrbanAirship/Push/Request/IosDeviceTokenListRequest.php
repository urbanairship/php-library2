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
use UrbanAirship\Push\Exception\UARequestException;
use UrbanAirship\Push\Log\UALog;
use UrbanAirship\Push\Url\IosUrl;
use UrbanAirship\Push\Response\UADeviceTokenListResponse;
use Httpful\Mime;

/**
 * Get a list of device tokens for the give application
 * Class IosDeviceTokenListRequest
 * @package UrbanAirship\Push\Request
 */
class IosDeviceTokenListRequest extends UARequest
{

    private $nextPageUrl;

    /**
     * Set the URL for the next page of tokens. This URL will be used instead
     * of the device token URL.
     * @param $nextPageUrl string URL for the next page of device tokens.
     * @return $this
     */
    public function setNextPageUrl($nextPageUrl)
    {
        $this->log->debug("Setting next page URL %s", $nextPageUrl);
        $this->nextPageUrl = $nextPageUrl;
        return $this;
    }

    /**
     * Create a new IosDeviceTokenListRequest
     * @return IosDeviceTokenListRequest
     */
    public static function request()
    {
        return new IosDeviceTokenListRequest();
    }

    /**
     * Build a Httpful/Request authenticated with the app key and secret. Metadata
     * on this object is used to create the registration payload.
     * @return Request
     */
    public function buildHttpRequest()
    {
        if (is_null($this->nextPageUrl)) {
            $url = IosUrl::iosDeviceTokenList();
        }
        else {
            $url = $this->nextPageUrl;
        }
        $request = $this->basicAuthRequest($url)->expectsType(Mime::JSON);
        return $request;

    }


    /**
     * Send the request. This will return a UADeviceTokenListResponse on any 200,
     * or throw a UARequestException.
     * @throws UARequestException
     * @return UADeviceTokenListResponse
     */
    public function send()
    {
        $request = $this->buildHttpRequest();
        $this->log->info("Sending Urban Airship Device Token list request");
        $this->log->debug(UALog::debugLogForRequest($request));
        return new UADeviceTokenListResponse($request->send());
    }

}