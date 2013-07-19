<?php
/*
Copyright 2013 Urban Airship and Contributors
*/

namespace UrbanAirship;

use Httpful\Request;
use UrbanAirship\Devices\DeviceTokenList;
use UrbanAirship\Devices\APIDList;
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

    public function listDeviceTokens($limit=null)
    {
        return new DeviceTokenList($this, $limit);
    }

    public function listAPIDs($limit=null)
    {
        return new APIDList($this, $limit);
    }

    public function push()
    {
        return new PushRequest($this);
    }

    public function scheduledPush()
    {
        return new ScheduledPushRequest($this);
    }

    public function buildUrl($path, $args=null) {
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

    public function request($method, $body, $uri, $contentType=null, $version=1, $request=null)
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

        if (is_null($request)) {
            // Tests pass in a pre-built Request. Normal code builds one here.
            $request = Request::init();
        }
        $request
            ->method($method)
            ->uri($uri)
            ->authenticateWith($this->key, $this->secret)
            ->body($body)
            ->addHeaders($headers);
        $response = $request->send();

        $logger->debug("Received response", array(
            "status" => $response->code,
            "headers" => $response->raw_headers,
            "body" => $response->raw_body));

        if ($response->code >= 300) {
            throw AirshipException::fromResponse($response);
        }
        return $response;
    }
}
