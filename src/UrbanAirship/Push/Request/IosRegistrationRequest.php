<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/13/13
 * Time: 2:51 PM
 */

namespace UrbanAirship\Push\Request;

use Httpful\Mime as Mime;
use Httpful\Request as Request;
use UrbanAirship\Push\Url\IosUrl;

class IosRegistrationRequest
{
    private $appKey;

    private $appSecret;

    private $registrationPayload;


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

    public function setRegistrationPayload($registrationPayload)
    {
        $this->registrationPayload = $registrationPayload;
        return $this;
    }

    private function buildRegistrationRequest()
    {
        $url = IosUrl::iosRegistration();
        return Request::put($url)
            ->authenticateWithBasic($this->appKey, $this->appSecret)
            ->mime(Mime::JSON)
            ->body($this->registrationPayload);
    }

    public function send()
    {
        $this->buildRegistrationRequest()->send();
    }

}


