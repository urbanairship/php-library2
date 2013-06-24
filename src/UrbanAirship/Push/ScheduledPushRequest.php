<?php

namespace UrbanAirship\Push;

class ScheduledPushRequest
{
    private $airship;
    private $schedule;
    private $name = null;
    private $push;

    function __construct($airship)
    {
        $this->airship = $airship;
    }

    function setSchedule($schedule)
    {
        $this->schedule = $schedule;
        return $this;
    }

    function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    function setPush($push)
    {
        $this->push = $push;
        return $this;
    }

    function getPayload()
    {
        $payload = array(
            'schedule' => $this->schedule,
            'push' => $this->push->getPayload()
        );
        if (!is_null($this->name)) {
            $payload['name'] = $this->name;
        }
        return $payload;
    }

    function send()
    {
        print_r(json_encode($this->getPayload()) . "\n\n\n");
        $response = $this->airship->request("POST",
            json_encode($this->getPayload()), "/api/schedules/", "application/json", 3);
        print_r($response);
    }

}
