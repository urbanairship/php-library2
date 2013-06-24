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

    function makeBody()
    {
        $payload = array(
            'audience' => $this->audience,
            'notification' => $this->notification,
            'device_types' => $this->deviceTypes
        );
        if (!is_null($this->options)) {
            $payload['options'] = $this->options;
        }
        return json_encode($payload);
    }

    function send()
    {
        print_r($this->makeBody() . "\n\n\n");
        $response = $this->airship->request(
            "POST", $this->makeBody(), "/api/push/", "application/json", 3);
        print_r($response);
    }

}
