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

    /**
     * Return a list of device tokens for the app. The DeviceTokenList implements
     * an Iterator.
     * @param int $limit Limit on tokens returned
     * @return DeviceTokenList
     */
    public function listDeviceTokens($limit=null)
    {
        return new DeviceTokenList($this, $limit);
    }

    /**
     * Return a list of APIDs
     * @param int $limit Limit on tokens returned
     * @return APIDList
     */
    public function listAPIDs($limit=null)
    {
        return new APIDList($this, $limit);
    }

    /**
     * Return a PushRequest that can be used to send a push
     * @return PushRequest
     */
    public function push()
    {
        return new PushRequest($this);
    }

    /**
     * Return a ScheduledPushRequest that can be used to setup a scheduled push.
     * @return ScheduledPushRequest
     */
    public function scheduledPush()
    {
        return new ScheduledPushRequest($this);
    }

    /**
     * Build a url against the BASE_URL with the given path and args.
     * @param string $path Path for URL, such as '/api/push/ $path
     * @param mixed $args Args for URL
     * @return string URL
     */
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

    /**
     * Send an authenticated request to the Urban Airship API. The request is
     * authenticated with the key and secret.
     *
     * @param string $method REST method for request
     * @param mixed $body Body of request, optional
     * @param string $uri URI for this request
     * @param string $contentType Content type for the request, optional
     * @param int $version version # for API, optional, default is 3
     * @param mixed $request Request object for this operation (PushRequest, etc)
     *   optional
     * @return \Httpful\associative|string
     * @throws AirshipException
     */
    public function request($method, $body, $uri, $contentType=null, $version=3, $request=null)
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
