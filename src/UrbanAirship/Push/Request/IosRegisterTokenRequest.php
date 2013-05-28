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
use UrbanAirship\Push\Payload\IosRegistrationPayload;
use UrbanAirship\Push\Url\IosUrl;


/**
 * Register an iOS device token with Urban Airship.
 * Class IosRegisterTokenRequest
 * @package UrbanAirship\Push\Request
 */
class IosRegisterTokenRequest extends UARequest
{

    /**
     * @var string Device token
     */
    protected  $deviceToken;

    // Don't allow construction outside factory method
    protected  function  __construct(){}


    /**
     * Sets a registration payload.
     * @param $registrationPayload IosRegistrationPayload
     * @return $this
     */
    public function setRegistrationPayload($registrationPayload)
    {
        return $this->setPayload($registrationPayload);
    }

    /**
     * Set a device token for registration requests. Device tokens are required
     * for registration
     * @param $deviceToken
     * @return $this
     */
    public function setDeviceToken($deviceToken)
    {
        $this->deviceToken = $deviceToken;
        return $this;
    }

    /**
     * Build a Httpful/Request authenticated with the app key and secret. Metadata
     * on this object is used to create the registration payload.
     * @return Request
     */
    public function buildRequest()
    {
        $url = IosUrl::iosRegistration($this->deviceToken);
        $request = $this->basicAuthRequest($url)->method(self::PUT);
        if (!is_null($this->payload)){
            $request->payload = $this->payload;
            $request->sendsType(MIme::JSON);
        }
        return $request;
    }

    /**
     * Create a new IosRegisterTokenRequest
     * @return IosRegisterTokenRequest
     */
    public static function request() {
        return new IosRegisterTokenRequest();
    }

    /**
     * Build a new request and send it. All calls to this method produce
     * new request objects.
     * @return \Httpful\Response Response for this request.
     */
    public function send()
    {
        $request =$this->buildRequest();
        return $request->send();
    }

}


