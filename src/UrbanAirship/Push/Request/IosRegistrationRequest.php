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

class IosRegistrationRequest extends UARequest
{


    private $deviceToken;

    // Don't allow construction outside factory method
    private function  __construct(){}

    public function setRegistrationPayload($registrationPayload)
    {
        return $this->setPayload($registrationPayload);
    }

    public function setDeviceToken($deviceToken)
    {
        $this->deviceToken = $deviceToken;
        return $this;
    }

    public  function buildRegistrationRequest()
    {
        $url = IosUrl::iosRegistration($this->deviceToken);
        $request = Request::put($url)->authenticateWithBasic($this->appKey,
            $this->appSecret);
        if (!is_null($this->payload)) {
            $request->mime(Mime::JSON)
                ->body($this->payload);
        }
        return $request;
    }

    public static function request() {
        return new IosRegistrationRequest();
    }

    public function send()
    {
        $request =$this->buildRegistrationRequest();
        return $request->send();
    }

}


