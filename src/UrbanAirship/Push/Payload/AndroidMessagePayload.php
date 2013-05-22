<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/22/13
 * Time: 10:15 AM
 */

namespace UrbanAirship\Push\Payload;


class AndroidMessagePayload extends Payload {

    const ANDROID_ALERT_KEY = "alert";
    const ANDROID_EXTRA_KEY = "extra";

    private $alert;
    private $extra;

    protected function __constructor(){}

    public function setAlert($alert)
    {
        $this->alert = $alert;
        return $this;
    }

    public function getAlert()
    {
        return $this->alert;
    }

    public function setExtra($extra)
    {
        $this->extra = $extra;
        return $this;
    }

    public function getExtra()
    {
        return $this->extra;
    }

    public function metadata()
    {
        return array(self::ANDROID_ALERT_KEY => $this->alert,
            self::ANDROID_EXTRA_KEY => $this->extra);
    }


    public static function payload()
    {
        return new AndroidMessagePayload();
    }


    public function jsonSerialize()
    {
        $metadata = $this->metadata();
        return $this->removeNilValuesFromPayload($metadata);
    }


}