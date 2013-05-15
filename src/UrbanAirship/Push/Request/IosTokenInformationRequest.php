<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/14/13
 * Time: 10:55 AM
 */

namespace UrbanAirship\Push\Request;


use UrbanAirship\Push\Url\IosUrl;
use Httpful\Mime;

class IosTokenInformationRequest extends IosRegisterTokenRequest
{
    public function setDeviceToken($deviceToken)
    {
        $this->deviceToken = $deviceToken;
        return $this;
    }
    public function buildTokenInformationRequest()
    {
        return  $this->tokenBasedAuthenticatedRequest($this->deviceToken)
            ->expectsType(Mime::JSON);
    }

    public static function request()
    {
        return new IosTokenInformationRequest();
    }

    public function send()
    {
        $url = IosUrl::iosDeviceInformation($this->deviceToken);
        $request = $this->buildTokenInformationRequest();
        return $request->send();
    }


}