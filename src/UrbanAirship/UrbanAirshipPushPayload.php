<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/2/13
 * Time: 4:04 PM
 */

namespace UrbanAirship;

require_once $_SERVER["UA_HANGER"].'/vendor/autoload.php';

class UrbanAirshipPushPayload implements \JsonSerializable
{
    const PUSH_PAYLOAD_APS_KEY = "aps";
    const PUSH_PAYLOAD_DEVICE_TOKENS_KEY = "device_tokens";
    const PUSH_PAYLOAD_ALIASES_KEY = "aliases";
    const PUSH_PAYLOAD_TAGS_KEY = "tags";
    const PUSH_PAYLOAD_SCHEDULE_KEY = "schedule_for";
    const PUSH_PAYLOAD_EXCLUDE_TOKENS_KEY = "exclude_tokens";


    protected $aps;
    protected $tags;
    protected $deviceTokens;
    protected $aliases;
    protected $scheduleFor;
    protected $exclude_tokens;


    public function setExcludeTokens($exclude_tokens)
    {
        $this->exclude_tokens = $exclude_tokens;
    }

    public function getExcludeTokens()
    {
        return $this->exclude_tokens;
    }

    public function getScheduleFor()
    {
        return $this->scheduleFor;
    }

    public function setScheduleFor($scheduleFor)
    {
        $this->scheduleFor = $scheduleFor;
    }

    public function getAliases()
    {
        return $this->aliases;
    }

    public function setAliases($aliases)
    {
        $this->aliases = $aliases;
    }

    public function setAps($aps)
    {
        $this->aps = $aps;
    }

    public function getAps()
    {
        return $this->aps;
    }

    public function setDeviceTokens($deviceTokens)
    {
        $this->deviceTokens = $deviceTokens;
    }

    public function getDeviceTokens()
    {
        return $this->deviceTokens;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    public function jsonSerialize()
    {
//        $aps = json_encode($this->aps);
        $json = array(self::PUSH_PAYLOAD_APS_KEY => json_encode($this->aps),
            self::PUSH_PAYLOAD_DEVICE_TOKENS_KEY => $this->deviceTokens,
            self::PUSH_PAYLOAD_ALIASES_KEY => $this->aliases,
            self::PUSH_PAYLOAD_TAGS_KEY => $this->tags,
            self::PUSH_PAYLOAD_SCHEDULE_KEY => $this->scheduleFor,
            self::PUSH_PAYLOAD_EXCLUDE_TOKENS_KEY => $this->exclude_tokens);
        return $json;
    }


}
