<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/30/13
 * Time: 3:31 PM
 */

namespace UrbanAirship\Push\Request;

use UrbanAirship\Push\Request\UARequest;
use UrbanAirship\Push\Url\NotificationUrl;
use UrbanAirship\Push\Response\UAResponse;
use UrbanAirship\Push\Log\UALog;
use Httpful\Mime;
use Httpful\Request;


class BatchPushNotificationRequest extends UARequest
{

    protected function __construct()
    {
        parent::__construct();
        $this->payload = array();
    }

    /**
     * Create a new BatchPushNotificationRequest
     * @return BatchPushNotificationRequest
     */
    public static function request()
    {
        return new BatchPushNotificationRequest();
    }

    /**
     * Payloads for push notification. See API documentation for payload options
     * and formats.
     * @param  $payload Array with the correct parameters for the given
     * push URL. Improperly formatted payloads will result in a 400 response
     * @return $this
     */
    public function setBatchNotificationPayload($payload)
    {
        $this->log->debug(sprintf("Set push notification payload %s", json_encode($payload, JSON_PRETTY_PRINT)));
        $this->setPayload($payload);
        return $this;
    }

    public function appendNotificationToBatch($notification)
    {
        $this->payload[] = $notification;
        return $this;
    }

    /**
     * Build a Httpful\Request with the parameters set on this object.
     * @return Request|mixed
     */
    public function buildHttpRequest()
    {
        $url = NotificationUrl::batchNotificationUrl();
        $request = self::basicAuthRequest($url)
            ->method(self::POST)
            ->sendsType(Mime::JSON)
            ->body(json_encode($this->payload));
        return $request;
    }

    /**
     * Send the request. This will return a UAResponse.
     * @return UAResponse
     */
    public function send()
    {
        $request = $this->buildHttpRequest();
        $this->log->debug(UALog::debugLogForRequest($request));
        return new UAResponse($request->send());
    }

}