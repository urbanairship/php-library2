<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/3/13
 * Time: 2:36 PM
 */

namespace UrbanAirship;

require_once $_SERVER["UA_HANGER"].'/vendor/autoload.php';

class UrbanAirshipPushPayload implements \JsonSerializable
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


    public function getDeviceTokens()
    {
        return $this->deviceTokens;
    }

    public function setDeviceTokens($deviceTokens)
    {
        $this->deviceTokens = $deviceTokens;
        return $this;
    }

    public function getApids()
    {
        return $this->apids;
    }

    public function setApids($apids)
    {
        $this->apids = $apids;
        return $this;
    }

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


    public function metadata()
    {
        // TODO add android, blackberry payloads as they come online
        $metadata =  array(
            self::PUSH_PAYLOAD_KEY_DEVICE_TOKENS => $this->deviceTokens,
            self::PUSH_PAYLOAD_KEY_APS => $this->aps->metadata(),
            self::PUSH_PAYLOAD_KEY_ALIASES => $this->aliases,
            self::PUSH_PAYLOAD_KEY_TAGS => $this->tags,
            self::PUSH_PAYLOAD_KEY_EXCLUDE_TOKENS => $this->excludeTokens,
            self::PUSH_PAYLOAD_KEY_SCHEDULE_FOR => $this->scheduleFor
        );

        return $metadata;
    }

    public function jsonSerialize()
    {
        return $this->metadata();
    }


}