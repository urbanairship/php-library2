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
        $headers = array("Accept" => sprintf(VERSION_STRING, $version));
        if (!is_null($contentType)) {
            $headers["Content-type"] = $contentType;
        }

        $logger = UALog::getLogger();
        $logger->debug("Making request", array(
            "method" => $method,
            "uri" => $uri,
            "headers" => $headers,
            "body" => $body));

        $request = Request::init()
            ->method($method)
            ->uri($uri)
            ->authenticateWith($this->key, $this->secret)
            ->body($body)
            ->addHeaders($headers);
        $response = $request->send();

        $logger->debug("Received response", array(
            "status" => $response->code,
            "headers" => $response->headers,
            "body" => $response->raw_body));

        return $response;
    }
}
