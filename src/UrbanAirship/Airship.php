<?php

namespace UrbanAirship;

use Httpful\Request;
use UrbanAirship\Push\PushRequest;
use UrbanAirship\Push\ScheduledPushRequest;

const BASE_URL = 'https://go.urbanairship.com';
const VERSION_STRING = 'application/vnd.urbanairship+json; version=%d;';

class Airship
{
    public $key;
    public $secret;

    public function __construct($appKey, $masterSecret)
    {
        $this->key = $appKey;
        $this->secret = $masterSecret;
    }

    public function push()
    {
        return new PushRequest($this);
    }

    public function scheduledPush()
    {
        return new ScheduledPushRequest($this);
    }

    public function request($method, $body, $path, $contentType=null, $version=1)
    {
        $uri = BASE_URL . $path;
        $request = Request::init()
            ->method($method)
            ->uri($uri)
            ->authenticateWith($this->key, $this->secret)
            ->body($body)
            ->addHeader("Accept", sprintf(VERSION_STRING, $version));
        if (!is_null($contentType)) {
            $request = $request->addHeader("Content-type", $contentType);
        }
        $response = $request->send();
        return $response;
    }
}
