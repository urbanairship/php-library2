<?php
/*
Copyright 2013 Urban Airship and Contributors
*/

namespace UrbanAirship\Push;

use UrbanAirship\UALog;

class ScheduledPushRequest
{
    const SCHEDULE_URL = "/api/schedules/";
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
        $uri = $this->airship->buildUrl(self::SCHEDULE_URL);
        $logger = UALog::getLogger();
        $response = $this->airship->request("POST",
            json_encode($this->getPayload()), $uri, "application/json", 3);
        $payload = json_decode($response->raw_body, true);
        $logger->info("Scheduled push sent successfully.", array("schedule_urls" => $payload['schedule_urls']));
        return new PushResponse($response);
    }

}
