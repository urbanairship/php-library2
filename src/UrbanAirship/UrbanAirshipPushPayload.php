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

    const APS_ALERT_KEY = "alert";
    const APS_BADGE_KEY = "badge";
    const APS_SOUND_KEY = "sound";

    const PAYLOAD_APS_KEY = "aps";
    const PAYLOAD_DEVICE_TOKENS_KEY = "device_tokens";
    const PAYLOAD_ALIAS_KEY = "aliases";
    const PAYLOAD_TAGS_KEY = "tags";
    const PAYLOAD_SCHEDULE_KEY = "schedule_for";
    const PAYLOAD_EXCLUDE_TOKENS_KEY = "exclude_tokens";


    protected $aps;
    protected $tags;
    protected $deviceTokens;
    protected $alias;
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

    public function setScheduleFor($scheduleFor)
    {
        $this->scheduleFor = $scheduleFor;
    }

    public function getScheduleFor()
    {
        return $this->scheduleFor;
    }

    public function __construct($aps=null){
        $this->aps =$aps;
    }

    public function setAliases($aliases){
        $this->alias = $aliases;
    }

    public function setAlias($alias)
    {
        $this->setAliases(array($alias));
    }

    public function getAlias()
    {
        return $this->alias;
    }

    public function setAps($aps)
    {
        $this->aps = $aps;
    }

    public function getAps()
    {
        return $this->aps;
    }

    public function setDeviceToken($deviceToken)
    {
        $this->setDeviceTokens(array($deviceToken));
    }

    public function setDeviceTokens($deviceTokens)
    {
        $this->deviceTokens = $deviceTokens;
    }

    public function getDeviceTokens()
    {
        return $this->deviceTokens;
    }

    public function setTag($tag){
        $this->setTags(array($tag));
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public static function getApsPayload($alert=null, $badge=null, $sound=null)
    {
        return array(
            self::APS_ALERT_KEY => $alert,
            self::APS_BADGE_KEY => $badge,
            self::APS_SOUND_KEY => $sound);
    }

    public function jsonSerialize()
    {
        $serialized = array();
        $serialized[self::PAYLOAD_APS_KEY] = $this->getAps();
        $serialized[self::PAYLOAD_DEVICE_TOKENS_KEY] = $this->getDeviceTokens();
        $serialized[self::PAYLOAD_ALIAS_KEY] = $this->getAlias();
        $serialized[self::PAYLOAD_EXCLUDE_TOKENS_KEY] = $this->getExcludeTokens();
        $serialized[self::PAYLOAD_SCHEDULE_KEY] = $this->getScheduleFor();
        $serialized[self::PAYLOAD_TAGS_KEY] = $this->getTags();
        return $serialized;
    }

}
