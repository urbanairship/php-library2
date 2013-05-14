<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/14/13
 * Time: 4:25 PM
 */

namespace UrbanAirship\Push\Request;

use UrbanAirship\Push\Url\Url;


class PushNotificationRequest extends NotificationRequest
{

    public function setPushNotificationPayload($payload)
    {
        $this->setPayload($payload);
        return $this;
    }

    public static function request()
    {
        return new PushNotificationRequest();
    }

    public function buildPushNotificationRequest()
    {
        $url = Url::pushNotificationUrl();
        return $this->buildNotificationRequest($url);
    }

    public function send()
    {
        $this->buildPushNotificationRequest()->send();
    }
}