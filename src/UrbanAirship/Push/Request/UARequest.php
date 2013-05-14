<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/14/13
 * Time: 10:29 AM
 */

namespace UrbanAirship\Push\Request;

use Httpful\Request;
use UrbanAirship\Push\Payload\Broadcast\BroadcastPayload;
use UrbanAirship\Push\Url\IosUrl;

abstract class UARequest
{

    /* HTTP Methods */
    const HEAD      = 'HEAD';
    const GET       = 'GET';
    const POST      = 'POST';
    const PUT       = 'PUT';
    const DELETE    = 'DELETE';

    protected $appKey;

    protected $appSecret;

    protected $payload;

    /**
     * @param $appKey string Application key
     * @return $this
     */
    public function setAppKey($appKey)
    {
        $this->appKey = $appKey;
        return $this;
    }

    /**
     * The secret to use for the request, either that master secret or app secret
     * depending
     * @param $appSecret string Application secret or master secret
     * @return $this
     */

    public function setAppSecret($appSecret)
    {
        $this->appSecret = $appSecret;
        return $this;
    }

    /**
     * Sets the payload for the request
     * @param $payload Object that conforms to JSON Serialization
     * @return $this UARequest
     */
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
        return self::basicAuthRequest($url);

    }

    /**
     * Basic auth request using this key (user) and secret (password)
     * @param $url string URL for request
     * @return Request GET request with basic auth
     */
    protected function basicAuthRequest($url)
    {
        return Request::get($url)
            ->authenticateWithBasic($this->appKey, $this->appSecret);
    }


}