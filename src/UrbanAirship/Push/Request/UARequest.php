<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/14/13
 * Time: 10:29 AM
 */

namespace UrbanAirship\Push\Request;

use Httpful\Request;
use UrbanAirship\Push\Payload\Broadcast\Ios;
use UrbanAirship\Push\Url\IosUrl;

abstract class UARequest
{

    const HEAD      = 'HEAD';
    const GET       = 'GET';
    const POST      = 'POST';
    const PUT       = 'PUT';
    const DELETE    = 'DELETE';

    protected $appKey;

    protected $appSecret;

    protected $payload;


    public function setAppKey($appKey)
    {
        $this->appKey = $appKey;
        return $this;
    }

    public function setAppSecret($appSecret)
    {
        $this->appSecret = $appSecret;
        return $this;
    }

    protected function setPayload($payload)
    {
        $this->payload = $payload;
        return $this;
    }

    /**
     * Returns an authenticated request with the current key and secret. Defaults
     * to GET, no parameters other than defaults or authentication are set.
     * @param $token string Device token
     * @return Request Get request authenticated with app key and secret
     */
    protected function tokenBasedAuthenticatedRequest($token)
    {
        $url = IosUrl::iosRegistration($token);
        return Request::get($url)
            ->authenticateWithBasic($this->appKey, $this->appSecret);
    }

}