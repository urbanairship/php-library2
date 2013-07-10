<?php

namespace UrbanAirship\Push;

use UrbanAirship\UALog;

class PushRequest
{
    private $airship;
    private $audience;
    private $notification;
    private $options = null;
    private $deviceTypes;

    function __construct($airship)
    {
        $this->airship = $airship;
    }

    function setAudience($audience)
    {
        $this->audience = $audience;
        return $this;
    }

    function setNotification($notification)
    {
        $this->notification = $notification;
        return $this;
    }

    function setDeviceTypes($deviceTypes)
    {
        $this->deviceTypes = $deviceTypes;
        return $this;
    }

    function setOptions($options)
    {
        $this->deviceTypes = $deviceTypes;
        return $this;
    }

    function getPayload()
    {
        $payload = array(
            'audience' => $this->audience,
            'notification' => $this->notification,
            'device_types' => $this->deviceTypes
        );
        if (!is_null($this->options)) {
            $payload['options'] = $this->options;
        }
        return $payload;
    }

    function send()
    {
        $logger = UALog::getLogger();

        $response = $this->airship->request("POST",
            json_encode($this->getPayload()), "/api/push/", "application/json", 3);

        if ($response->code < 300 && $response->code >= 200) {
            $payload = json_decode($response->raw_body, true);
            // Successful push
            $logger->info("Push sent successfully.", array("push_ids" => $payload['push_ids']));
            return new PushResponse($response);
        }
    }

}
