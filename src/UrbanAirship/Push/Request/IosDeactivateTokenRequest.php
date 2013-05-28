<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/14/13
 * Time: 12:33 PM
 */

namespace UrbanAirship\Push\Request;

use \Httpful\Mime;
use UrbanAirship\Push\Exception\UARequestException;
use UrbanAirship\Push\Response\UAResponse;

/**
 * Deactivate the given token with Urban Airship.
 * Class IosDeactivateTokenRequest
 * @package UrbanAirship\Push\Request
 */
class IosDeactivateTokenRequest extends IosRegisterTokenRequest
{

    /**
     * Create a new IosDeactivateTokenRequest.
     * @return IosDeactivateTokenRequest|IosRegisterTokenRequest
     */
    public static function request()
    {
        return new IosDeactivateTokenRequest();
    }

    /**
     * Create the Httpful/Request authenticated with the app key and secret.
     * The HTTP method is DELETE.
     * @return \Httpful\Request
     */
    public function buildHttpRequest()
    {
        $request = parent::buildHttpRequest();
        $request->method(self::DELETE);
        return $request;
    }

    /**
     * Send the request. This will return a UAResponse on any 200, or throw
     * a UARequestException.
     * @throws UARequestException
     * @return UAResponse
     */
    public function send()
    {
        $request = $this->buildHttpRequest();
        return new UAResponse($request->send());
    }
}