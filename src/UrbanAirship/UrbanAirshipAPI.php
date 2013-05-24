<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/16/13
 * Time: 2:49 PM
 */

namespace UrbanAirship;

require_once '../../vendor/autoload.php';

use UrbanAirship\Push\Payload\IosRegistrationPayload;
use UrbanAirship\Push\Request;
use UrbanAirship\Push\Url;


class UrbanAirshipAPI {

    protected $appKey;
    protected $appSecret;
    protected $appMasterSecret;

    public function setAppMasterSecret($appMasterSecret)
    {
        $this->appMasterSecret = $appMasterSecret;
        return $this;
    }

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

    public function registerDeviceToken($deviceToken, $registrationPayload=null)
    {
        //TODO make some more requests, see what fits in here.
        $request = Request\IosRegisterTokenRequest::request()
            ->setAppKey($this->appKey)
            ->setAppSecret($this->appSecret)
            ->setDeviceToken($deviceToken)
            ->buildRequest();
        return $request->send();
    }



}