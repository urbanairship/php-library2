<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/14/13
 * Time: 12:33 PM
 */

namespace UrbanAirship\Push\Request;

class IosDeactivateTokenRequest extends IosRegisterTokenRequest
{

    public static function request()
    {
        return new IosDeactivateTokenRequest();
    }

    public function buildDeactivateRequest()
    {
        $request = parent::buildDeactivateRequest();
        return $request->method(self::DELETE);
    }
}