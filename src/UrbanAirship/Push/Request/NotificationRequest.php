<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/14/13
 * Time: 1:35 PM
 */

namespace UrbanAirship\Push\Request;

use Httpful\Request;
use Httpful\Mime;

abstract class NotificationRequest extends UARequest
{
    protected $url;

    public  function buildHttpRequest()
    {
        $request = self::basicAuthRequest($this->url)
            ->method(self::POST)
            ->sendsType(Mime::JSON)
            ->body(json_encode($this->payload));
        return $request;
    }



}