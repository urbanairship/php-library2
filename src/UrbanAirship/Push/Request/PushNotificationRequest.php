<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/14/13
 * Time: 4:25 PM
 */

namespace UrbanAirship\Push\Request;

use UrbanAirship\Push\Exception\UARequestException;
use UrbanAirship\Push\Response\UAResponse;

class PushNotificationRequest extends NotificationRequest
{

    /**
     * @param $url string URL to send the message to, push, batch, or broadcast
     */
    protected  function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Payloads for push notification. See API documentation for payload options
     * and formats.
     * @param $payload object Array with the correct parameters for the given
     * push URL. Improperly formatted payloads will result in a 400 response
     * @return $this
     */
    public function setPushNotificationPayload($payload)
    {
        $this->setPayload($payload);
        return $this;
    }

    /**
     * @param $url string URL for the push notification endpoint, either push,
     * batch, or broadcast.
     * @return PushNotificationRequest
     */
    public static function request($url)
    {
        return new PushNotificationRequest($url);
    }

    /**
     * Send the request. This will return a UAResponse on any 200, or throw
     * a UARequestException.
     * @throws UARequestException
     * @return UAResponse
     */
    public function send()
    {
        return new UAResponse($this->buildHttpRequest()->send());
    }
}