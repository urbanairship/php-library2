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
use UrbanAirship\Push\Url\IosUrl;
use UrbanAirship\Push\Payload\Payload;

abstract class UARequest
{

    /* HTTP Methods */
    const GET       = 'GET';
    const POST      = 'POST';
    const PUT       = 'PUT';
    const DELETE    = 'DELETE';

    /**
     * @var string Application key
     */
    protected $appKey;

    /**
     * @var string Application master secret
     */
    protected $appSecret;

    /**
     * @var Payload Payload for this request
     */
    protected $payload;

    /**
     * @param $appKey string Application key
     * @return $this
     */
    public function setAppKey($appKey)
    {
        $this->appKey = $appKey;
        return $this;
    }

    /**
     * The secret to use for the request, either that master secret or app secret
     * depending
     * @param $appSecret string Application secret or master secret
     * @return $this
     */

    public function setAppSecret($appSecret)
    {
        $this->appSecret = $appSecret;
        return $this;
    }

    /**
     * Sets the payload for the request
     * @param $payload Payload that conforms to JSON Serialization
     * @return $this UARequest
     */
    protected function setPayload($payload)
    {
        $this->payload = $payload;
        return $this;
    }

    /**
     * Basic auth request using this key (user) and secret (password)
     * @param $url string URL for request
     * @return Request GET request with basic auth
     */
    protected function basicAuthRequest($url)
    {
        return Request::get($url)
            ->authenticateWithBasic($this->appKey, $this->appSecret);
    }

    /**
     * Build a request.
     * @return mixed
     */
    public abstract function buildHttpRequest();


}