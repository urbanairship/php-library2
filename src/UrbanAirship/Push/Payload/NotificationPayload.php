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

/**
 * A notification payload is used to send metadata associated with a push
 * message to the Urban Airship  API.
 * class NotificationPayload
 * @package UrbanAirship\Push\Payload
 */

class NotificationPayload extends Payload
{

    /* Device identifiers */
    const PUSH_PAYLOAD_KEY_DEVICE_TOKENS = "device_tokens";
    const PUSH_PAYLOAD_KEY_APIDS = "apids";
    const PUSH_PAYLOAD_KEY_DEVICE_PINS = "device_pins";

    /* Message payloads */
    const PUSH_PAYLOAD_KEY_APS = "aps";
    const PUSH_PAYLOAD_KEY_ANDROID = "android";
    const PUSH_PAYLOAD_KEY_BLACKBERRY = "blackberry";

    /* Metadata */
    const PUSH_PAYLOAD_KEY_ALIASES = "aliases";
    const PUSH_PAYLOAD_KEY_TAGS = "tags";
    const PUSH_PAYLOAD_KEY_EXCLUDE_TOKENS = "exclude_tokens";
    const PUSH_PAYLOAD_KEY_SCHEDULE_FOR = "schedule_for";

    /* Device identifiers */
    private $deviceTokens;
    private $apids;
    private $devicePins;

    /* Message payloads */
    private $aps;
    private $android;
    private $blackberry;

    /* Metadata */
    private $aliases;
    private $tags;
    private $excludeTokens;
    private $scheduleFor;

    protected function __constructor(){}


    /**
     * Array of device tokens
     * @return mixed
     */
    public function getDeviceTokens()
    {
        return $this->deviceTokens;
    }

    /**
     * Sets tokens to message to.
     * @param $deviceTokens Array Array of device tokens
     * @return $this
     */
    public function setDeviceTokens($deviceTokens)
    {
        $this->deviceTokens = $deviceTokens;
        return $this;
    }

    /**
     * Current array of APIDs
     * @return mixed
     */
    public function getApids()
    {
        return $this->apids;
    }

    /**
     * @param $apids Array Sets the array of APIDs
     * @return $this
     */
    public function setApids($apids)
    {
        $this->apids = $apids;
        return $this;
    }

    /**
     * Current Blackberry device pins
     * @return mixed
     */
    public function getDevicePins()
    {
        return $this->devicePins;
    }

    /**
     * Set the device pins for this message. Used with Blackberry messages.
     * @param $devicePins
     */
    public function setDevicePins($devicePins)
    {
        $this->devicePins = $devicePins;
    }

    /**
     * Get the APS message payload, used for iOS push messages.
     * @return IosMessagePayload
     */
    public function getAps()
    {
        return $this->aps;
    }

    /**
     * Set a new IosMessagePayload. This will be message delivered to the device.
     * @param $aps
     * @return $this
     */
    public function setAps($aps)
    {
        $this->aps = $aps;
        return $this;
    }

    /**
     * Get the Android message payload.
     * @return AndroidMessagePayload
     */
    public function getAndroid()
    {
        return $this->android;
    }

    /**
     * Set a new AndroidMessagePayload. This will be the message delivered to the
     * device.
     * @param $android
     * @return $this
     */
    public function setAndroid($android)
    {
        $this->android = $android;
        return $this;
    }

    /**
     * Get the BlackberryMessagePayload.
     * @return BlackberryMessagePayload
     */
    public function getBlackberry()
    {
        return $this->blackberry;
    }

    /**
     * Set a new BlackberryMessagePayload. This will be the message delivered to
     * the device.
     * @param $blackberry
     * @return $this
     */
    public function setBlackberry($blackberry)
    {
        $this->blackberry = $blackberry;
        return $this;
    }

    /**
     * Get the array of aliases for this message
     * @return mixed
     */
    public function getAliases()
    {
        return $this->aliases;
    }

    /**
     * Set a new array of aliases for this message
     * @param $aliases
     * @return $this
     */
    public function setAliases($aliases)
    {
        $this->aliases = $aliases;
        return $this;
    }

    /**
     * Get the tags for this message
     * @return mixed Current tags
     */
    public function getTags()
    {
        $this->tags;
    }

    /**
     * Set and array of tags for this message.
     * @param $tags
     * @return $this
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * Get the schedule for variables.
     */
    public function getScheduleFor()
    {
        $this->scheduleFor;
    }

    /**
     * Set the "schedule_for" parameter of this payload, which represents a future
     * time in ISO 8601 UTC format.      * If included, the message will be delivered at
     * the given time. If omitted, the message will be delivered immediately.
     *
     * @example "2012-01-01 11:16:00"
     *
     * @param $scheduleFor
     * @return $this
     */
    public function setScheduleFor($scheduleFor)
    {
        $this->scheduleFor = $scheduleFor;
        return $this;
    }

    /**
     * Create a new NotificationPayload
     * @return NotificationPayload
     */
    public static function payload()
    {
        return new NotificationPayload();
    }

    /**
     * Get an array with all of the object metadata. Keys are set for the
     * Urban Airship API, values are set to the current value, or nil.
     * @return array
     */
    public function metadata()
    {
        $metadata = array();
        if (!is_null($this->aps)) {
            $metadata[self::PUSH_PAYLOAD_KEY_APS] =
                $this->removeNilValuesFromPayload($this->aps->metadata());
        }
        if (!is_null($this->android)) {
            $metadata[self::PUSH_PAYLOAD_KEY_ANDROID] =
                $this->removeNilValuesFromPayload($this->android->metadata());
        }
        $metadata[self::PUSH_PAYLOAD_KEY_APIDS] = $this->apids;
        $metadata[self::PUSH_PAYLOAD_KEY_DEVICE_TOKENS] = $this->deviceTokens;
        $metadata[self::PUSH_PAYLOAD_KEY_ALIASES] = $this->aliases;
        $metadata[self::PUSH_PAYLOAD_KEY_TAGS] = $this->tags;
        $metadata[self::PUSH_PAYLOAD_KEY_EXCLUDE_TOKENS] = $this->excludeTokens;
        $metadata[self::PUSH_PAYLOAD_KEY_SCHEDULE_FOR] = $this->scheduleFor;

        return $metadata;
    }

    /**
     * Takes all the parameters of the object and creates a JSON object
     * with the proper keys for the Urban Airship API
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        $payload = $this->metadata();
        return $this->removeNilValuesFromPayload($payload);
    }


}