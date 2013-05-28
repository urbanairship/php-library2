<?php
//    Copyright 2012 Urban Airship
//
//    Licensed under the Apache License, Version 2.0 (the "License");
//    you may not use this file except in compliance with the License.
//    You may obtain a copy of the License at
//
//    http://www.apache.org/licenses/LICENSE-2.0
//
//    Unless required by applicable law or agreed to in writing, software
//    distributed under the License is distributed on an "AS IS" BASIS,
//    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
//    See the License for the specific language governing permissions and
//    limitations under the License.

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