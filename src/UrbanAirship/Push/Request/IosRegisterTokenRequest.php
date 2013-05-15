<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/13/13
 * Time: 2:51 PM
 */

namespace UrbanAirship\Push\Request;

use Httpful\Http;
use Httpful\Mime as Mime;
use Httpful\Request as Request;
use UrbanAirship\Push\Url\IosUrl;

class IosRegisterTokenRequest extends UARequest
{

    protected  $deviceToken;

    // Don't allow construction outside factory method
    protected  function  __construct(){}

    public function setRegistrationPayload($registrationPayload)
    {
        return $this->setPayload($registrationPayload);
    }

    public function setDeviceToken($deviceToken)
    {
        $this->deviceToken = $deviceToken;
        return $this;
    }

    public function buildRequest()
    {
        $url = IosUrl::iosRegistration($this->deviceToken);
        $request = $this->basicAuthRequest($url)->method(self::PUT);
        if (!is_null($this->payload)){
            $request->payload = $this->payload;
        }
        return $request;
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

    public static function request() {
        return new IosRegisterTokenRequest();
    }

    public function send()
    {
        $request =$this->tokenBasedAuthenticatedRequest($this->deviceToken);
        return $request->send();
    }

}


