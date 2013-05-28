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
    public function buildRequest()
    {
        $request = parent::buildRequest();
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
     * Build a new request and send it. All calls to this method produce
     * new request objects.
     * @return \Httpful\Response Response for this request.
     */
    public function send()
    {
        $request = $this->buildRequest();
        return $request->send();
    }


}