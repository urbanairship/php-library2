<?php

namespace UrbanAirship;

use Httpful\Request;
use UrbanAirship\Push\PushRequest;

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

    public function request($method, $body, $path, $contentType, $version)
    {
        $uri = BASE_URL . $path;
        $response = Request::init()
            ->method($method)
            ->uri($uri)
            ->authenticateWith($this->key, $this->secret)
            ->addHeader("Content-type", sprintf(VERSION_STRING, $version))
            ->addHeader("Accept", sprintf(VERSION_STRING, $version))
            ->body($body)
            ->send();
        return $response;
    }
}
