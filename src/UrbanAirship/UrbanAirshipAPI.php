<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/16/13
 * Time: 2:49 PM
 */

namespace UrbanAirship;

require_once '../../vendor/autoload.php';

use UrbanAirship\Push\Url\NotificationUrl;

use UrbanAirship\Push\Response;

use UrbanAirship\Push\Request\PushNotificationRequest;
use UrbanAirship\Push\Request\IosRegisterTokenRequest;

use UrbanAirship\Push\Payload\NotificationPayload;
use UrbanAirship\Push\Payload\IosRegistrationPayload;


/**
 * Class for Urban Airship API interactions. This class is used for
 * basic API interactions such as registering, sending messages, accessing
 * device metadata.
 *
 * Class UrbanAirshipAPI
 * @package UrbanAirship\
 */

class UrbanAirshipAPI {

    /** @var  string Application key */
    protected $appKey;
    /** @var  string Application master secret */
    protected $appMasterSecret;

    /**
     * The current master secret.
     * @return string Master secret.
     */
    public function getAppMasterSecret()
    {
        return $this->appMasterSecret;
    }

    /**
     * Set the master secret for the API object. This should be the
     * master secret for the app you wish to interact with.
     * @param $appMasterSecret string Master secret for this application.
     * @return $this
     */
    public function setAppMasterSecret($appMasterSecret)
    {
        $this->appMasterSecret = $appMasterSecret;
        return $this;
    }

    /**
     * The current app key.
     * @return  App Key
     */
    public function getAppKey()
    {
        return $this->appKey;
    }

    /**
     * Set the app key for the Urban Airship application you want to interact
     * with.
     * @param $appKey string Application key.
     * @return $this
     */
    public function setAppKey($appKey)
    {
        $this->appKey = $appKey;
        return $this;
    }

    /**
     * Register a device token with the given payload with the Urban Airship
     * servers. Will return a UAResponse on success, or raise an UARequestException
     * on a non 200 server response.
     *
     * @param $deviceToken string Device Token
     * @param $registrationPayload IosRegistrationPayload Optional registration payload
     * @return Response\UAResponse
     */
    public function registerDeviceToken($deviceToken, $registrationPayload=null)
    {
        //TODO make some more requests, see what fits in here.
        $request = IosRegisterTokenRequest::request()
            ->setAppKey($this->appKey)
            ->setAppSecret($this->appMasterSecret)
            ->setDeviceToken($deviceToken);

        if(!is_null($registrationPayload)) {
            $request->setRegistrationPayload(json_encode($registrationPayload));
        }

        return new Response\UAResponse($request->buildRequest()->send());
    }

    /**
     * Send a broadcast push notification with the given payload.
     * @param NotificationPayload $notificationPayload
     * @return Response\UAResponse
     */
    public function sendBroadcastPushMessage(NotificationPayload $notificationPayload)
    {
        $url = NotificationUrl::broadcastNotificationUrl();
        $request = PushNotificationRequest::request($url)
            ->setAppKey($this->appKey)
            ->setAppSecret($this->appMasterSecret)
            ->setPushNotificationPayload($notificationPayload);
        return new Response\UAResponse($request->send());
    }

    public function sendPushNotification(NotificationPayload $notificationPayload)
    {
        $url = NotificationUrl::pushNotificationUrl();
        $request = PushNotificationRequest::request($url)
            ->setAppKey($this->appKey)
            ->setAppSecret($this->appMasterSecret)
            ->setPushNotificationPayload($notificationPayload);
        return new Response\UAResponse($request->send());
    }




}