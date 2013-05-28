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

namespace UrbanAirship\Push\Response;

use Httpful\Response;
use UrbanAirship\Push\Exception\UARequestException;

/**
 * Response object returned from Urban Airship requests. A lightweight wrapper
 * around an \Httpful\Response.
 *
 * Class UAResponse
 * @package UrbanAirship\Push\Response
 */
class UAResponse {

    protected  $response;

    /**
     * Create a UAResponse with the given \Httpful\Response. If the response
     * has errors (non 2**), this will throw a UARequestException.
     * @param $response
     * @throws UARequestException
     */
    public function __construct($response){
        $this->response = $response;
        if ($response->hasErrors()){
            throw new UARequestException($response);
        }
    }

    /**
     * Get the response for this request
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Get the response code from the Response.
     * @return mixed
     */
    public  function getResponseCode()
    {
        return $this->response->code;
    }

    /**
     * Get the response body.
     * @return mixed
     */
    public function getResponseBody()
    {
        return $this->response->body;
    }




}