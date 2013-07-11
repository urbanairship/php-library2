<?php

namespace UrbanAirship;

use Httpful\Request;
use UrbanAirship\Push\PushRequest;
use UrbanAirship\Push\ScheduledPushRequest;


class Airship
{

    const BASE_URL = 'https://go.urbanairship.com';
    const VERSION_STRING = 'application/vnd.urbanairship+json; version=%d;';

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

    public function build_url($path, $args=null) {
        $url = self::BASE_URL . $path;

        if (isset($args)) {
            $params = array();
            $url = $url . "?";

            foreach ($args as $key => $value) {
                $params[] = urlencode($key) . "=" . urlencode($value);
            }
            $url = $url . implode("&", $params);
        }
        return $url;
    }

    public function request($method, $body, $uri, $contentType=null, $version=1)
    {
        $headers = array("Accept" => sprintf(self::VERSION_STRING, $version));
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

        if ($response->code >= 300) {
            throw AirshipException::fromResponse($response);
        }
        return $response;
    }
}
