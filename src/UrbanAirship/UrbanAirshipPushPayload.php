<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/2/13
 * Time: 4:04 PM
 */

namespace UrbanAirship;

require_once $_SERVER["UA_HANGER"].'/vendor/autoload.php';

class UrbanAirshipPushPayload extends UrbanAirshipMetadata
{

    protected $aps;
    protected $tags;
    protected $deviceTokens;
    protected $alias;
    protected $scheduleFor;
    protected $exclude_tokens;


    public function setExcludeTokens($exclude_tokens)
    {
        $this->setMetadata(self::PUSH_PAYLOAD_EXCLUDE_TOKENS_KEY, $exclude_tokens);
    }

    public function getExcludeTokens()
    {
        return $this->getMetadata(self::PUSH_PAYLOAD_EXCLUDE_TOKENS_KEY);
    }

    public function getScheduleFor()
    {
        return $this->getMetadata(self::PUSH_PAYLOAD_SCHEDULE_KEY);
    }

    public function setScheduleFor($scheduleFor)
    {
        $this->setMetadata(self::PUSH_PAYLOAD_SCHEDULE_KEY, $scheduleFor);
    }

    public function getAliases()
    {
        return $this->getMetadata(self::PUSH_PAYLOAD_ALIASES_KEY);
    }

    public function setAliases($aliases)
    {
        $this->setMetadata(self::PUSH_PAYLOAD_ALIASES_KEY, $aliases);
    }

    public function setAps($aps)
    {
        $this->setMetadata(self::PUSH_PAYLOAD_APS_KEY, $aps);
    }

    public function getAps()
    {
        return $this->getMetadata(self::PUSH_PAYLOAD_APS_KEY);
    }

    public function setDeviceTokens($deviceTokens)
    {
        $this->setMetadata(self::PUSH_PAYLOAD_DEVICE_TOKENS_KEY, $deviceTokens);
    }

    public function getDeviceTokens()
    {
        return $this->getMetadata(self::PUSH_PAYLOAD_DEVICE_TOKENS_KEY);
    }

    public function getTags()
    {
        return $this->getMetadata(self::PUSH_PAYLOAD_TAGS_KEY);
    }

    public function setTags($tags)
    {
        $this->setMetadata(self::PUSH_PAYLOAD_TAGS_KEY, $tags);
    }

}
