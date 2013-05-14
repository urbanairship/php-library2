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

class IosSendNotificationRequest extends UARequest
{

    public static function request()
    {
        return new IosSendNotificationRequest();
    }

    public function setBroadcastPayload($payload)
    {
        $this->setPayload($payload);
        return $this;
    }

    public function buildSendNotificationRequest()
    {
        $url = IosUrl::iosPushMessage();
        $request = self::basicAuthRequest($url)
            ->method(self::POST)
            ->sendsType(Mime::JSON)
            ->body(json_encode($this->payload));
        return $request;
    }

    public function send()
    {
        return $this->buildSendNotificationRequest()->send();
    }

}