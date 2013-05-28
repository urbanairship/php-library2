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

namespace UrbanAirship\Push\Exception;

use Httpful\Response;

/**
 * Thrown for a non 2** server response from Urban Airship. Contains the
 * original http request, and the response.
 * Class UARequestException
 * @package UrbanAirship\Push\Exception
 */
class UARequestException extends \Exception {

    private $response;

    /**
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        parent::__construct($response->body, $response->code);
        $this->response = $response;
    }

    /**
     * Get the Httpful/Request that was made.
     * @return \Httpful\Request
     */
    public function getRequest()
    {
        return $this->response->request;
    }

    /**
     * Get the Httpful\Response that caused the exception.
     * @return \Httpful\Response
     */
    public function getResponse()
    {
        return $this->response;
    }


}