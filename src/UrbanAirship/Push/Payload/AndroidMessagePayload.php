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

    private $alert;
    private $extra;

    protected function __constructor(){}

    /**
     * Set the message for this notification
     * @param $alert
     * @return $this
     */
    public function setAlert($alert)
    {
        $this->alert = $alert;
        return $this;
    }

    /**
     * The current alert message
     * @return string Current alert
     */
    public function getAlert()
    {
        return $this->alert;
    }

    /**
     * Array of key value pairs to pass along with the message.
     * @param $extra Array of key value extras
     * @return $this
     */
    public function setExtra($extra)
    {
        $this->extra = $extra;
        return $this;
    }

    /**
     * Current extras.
     * @return array
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * Produce an array that can be converted to JSON for the payload
     * @return array
     */
    public function metadata()
    {
        $payload =  array(self::ANDROID_ALERT_KEY => $this->alert);
        if (!is_null($this->extra)){
            $payload = array_merge($payload, $this->extra);
        }
        return $payload;
    }

    /**
     * Returns a new AndroidMessagePayload object
     * @return IosMessagePayload
     */
    public static function payload()
    {
        return new AndroidMessagePayload();
    }


    /**
     * Takes all the parameters of the object and creates a JSON object
     * with the proper keys for the Urban Airship API
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        $metadata = $this->metadata();
        return $this->removeNilValuesFromPayload($metadata);
    }


}