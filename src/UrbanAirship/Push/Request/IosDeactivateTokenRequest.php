<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/14/13
 * Time: 12:33 PM
 */

namespace UrbanAirship\Push\Request;

use \Httpful\Mime;

/**
 * Deactivate the given token with Urban Airship.
 * Class IosDeactivateTokenRequest
 * @package UrbanAirship\Push\Request
 */
class IosDeactivateTokenRequest extends IosRegisterTokenRequest
{

    public static function request()
    {
        return new IosDeactivateTokenRequest();
    }

    public function buildRequest()
    {
        $request = $this->tokenBasedAuthenticatedRequest($this->deviceToken);
        $request->method(self::DELETE);
        if (!is_null($this->payload)) {
            $request->mime(Mime::JSON)
                ->body($this->payload);
        }
        return $request;
    }
}