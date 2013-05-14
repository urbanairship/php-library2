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
use UrbanAirship\Push\Url\IosUrl;

abstract class NotificationRequest extends UARequest
{
    public abstract function send();

    protected function buildNotificationRequest($url)
    {
        $request = self::basicAuthRequest($url)
            ->method(self::POST)
            ->sendsType(Mime::JSON)
            ->body(json_encode($this->payload));
        return $request;
    }



}