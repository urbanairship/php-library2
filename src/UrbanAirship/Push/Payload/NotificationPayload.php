<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/3/13
 * Time: 2:36 PM
 */

namespace UrbanAirship\Push\Payload;

/**
 * Class BroadcastPayload
 * Represents a broadcast push through Urban Airship. Devices can be targeted
 * using the different API methods available on each platform.
 *
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

    public function setDevicePins($devicePins)
    {
        $this->devicePins = $devicePins;
    }

    public function getAps()
    {
        return $this->aps;
    }

    public function setAps($aps)
    {
        $this->aps = $aps;
        return $this;
    }

    public function getAndroid()
    {
        return $this->android;
    }

    public function setAndroid($android)
    {
        $this->android = $android;
        return $this;
    }

    public function getBlackberry()
    {
        return $this->blackberry;
    }

    public function setBlackberry($blackberry)
    {
        $this->blackberry = $blackberry;
        return $this;
    }

    public function getAliases()
    {
        return $this->aliases;
    }

    public function setAliases($aliases)
    {
        $this->aliases = $aliases;
        return $this;
    }

    public function getExcludeTokens()
    {
        return $this->excludeTokens;
    }

    public function setExcludeTokens($excludeTokens)
    {
        $this->excludeTokens = $excludeTokens;
        return $this;
    }

    public function getTags()
    {
        $this->tags;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
        return $this;
    }

    public function getScheduleFor()
    {
        $this->scheduleFor;
    }

    public function setScheduleFor($scheduleFor)
    {
        $this->scheduleFor = $scheduleFor;
        return $this;
    }

    public static function payload()
    {
        return new NotificationPayload();
    }

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

    public function jsonSerialize()
    {
        $payload = $this->metadata();
        return $this->removeNilValuesFromPayload($payload);
    }


}