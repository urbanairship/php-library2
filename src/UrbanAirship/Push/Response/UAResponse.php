<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/23/13
 * Time: 8:34 AM
 */

namespace UrbanAirship\Push\Response;

use Httpful\Response;
use UrbanAirship\Push\Exception\UARequestException;

class UAResponse {

    protected  $response;

    public function __construct($response){
        $this->response = $response;
        if ($response->hasErrors()){
            throw new UARequestException($response);
        }
    }

    public function getResponse()
    {
        return $this->response;
    }

    public  function getResponseCode()
    {
        return $this->response->code;
    }

    public function getResponseBody()
    {
        return $this->response->body;
    }




}