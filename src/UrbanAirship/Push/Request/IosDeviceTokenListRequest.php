<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/14/13
 * Time: 3:33 PM
 */

namespace UrbanAirship\Push\Request;

use UrbanAirship\Push\Url\IosUrl;

class IosDeviceTokenListRequest extends UARequest
{
    public static function request()
    {
        return new IosDeviceTokenListRequest();
    }

    public function buildRequest()
    {
        $url = IosUrl::iosDeviceTokenList();
        return $this->basicAuthRequest($url);
    }

    public function send()
    {
        return $this->buildRequest()->send();
    }

}