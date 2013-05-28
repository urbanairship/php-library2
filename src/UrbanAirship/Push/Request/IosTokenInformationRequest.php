<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/14/13
 * Time: 10:55 AM
 */

namespace UrbanAirship\Push\Request;


use UrbanAirship\Push\Exception\UARequestException;
use UrbanAirship\Push\Response\UAResponse;
use UrbanAirship\Push\Url\IosUrl;
use Httpful\Mime;

/**
 * Get metadata from the Urban Airship API about this device token.
 * Class IosTokenInformationRequest
 * @package UrbanAirship\Push\Request
 */
class IosTokenInformationRequest extends IosRegisterTokenRequest
{

    /**
     * Set the device token for this request. This is required.
     * @param $deviceToken
     * @return $this
     */
    public function setDeviceToken($deviceToken)
    {
        $this->deviceToken = $deviceToken;
        return $this;
    }

    /**
     * Build a Httpful/Request using the metadata associated with this object.
     * @return \Httpful\Request
     */
    public function buildHttpRequest()
    {
        $request = parent::buildHttpRequest();
        $request->method(self::GET);
        return $request;
    }

    /**
     * Create a IosTokenInformationRequest.
     * @return IosRegisterTokenRequest|IosTokenInformationRequest
     */
    public static function request()
    {
        return new IosTokenInformationRequest();
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