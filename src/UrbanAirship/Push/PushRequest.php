<?php

namespace UrbanAirship\Push;

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
        print_r($this->json_encode($this->getPayload()) . "\n\n\n");
        $response = $this->airship->request("POST",
            json_encode($this->getPayload()), "/api/push/", "application/json", 3);
        print_r($response);
    }

}
