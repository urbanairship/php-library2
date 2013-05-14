<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/14/13
 * Time: 10:29 AM
 */

namespace UrbanAirship\Push\Request;

use Httpful\Request;


abstract class UARequest
{
    protected $appKey;

    protected $appSecret;

    protected $payload;


    public function setAppKey($appKey)
    {
        $this->appKey = $appKey;
        return $this;
    }

    public function setAppSecret($appSecret)
    {
        $this->appSecret = $appSecret;
        return $this;
    }

    protected function setPayload($payload)
    {
        $this->payload = $payload;
        return $this;
    }
}