<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/3/13
 * Time: 2:36 PM
 */

namespace UrbanAirship;

require_once $_SERVER["UA_HANGER"].'/vendor/autoload.php';

class UrbanAirshipIosPushMessage extends UrbanAirshipMetadata
{
    private $aps;
    private $pushPayload;

    function __construct()
    {
        $this->aps = new UrbanAirshipApsPayload();
        $this->pushPayload = new UrbanAirshipPushPayload();
    }

    public function setAlert($alert)
    {
        $this->aps->setAlert($alert);
        return $this;
    }

    public function setBadge($badge)
    {
        $this->aps->setBadge($badge);
        return $this;
    }

    public function setSound($sound)
    {
        $this->aps->setSound($sound);
        return $this;
    }

    public function getDeviceTokens()
    {
        $this->pushPayload->getDeviceTokens();
    }

    public function setDeviceTokens($deviceTokens)
    {
        $this->pushPayload->setDeviceTokens($deviceTokens);
        return $this;
    }

    public function getTags()
    {
        $this->pushPayload->getTags();
    }

    public function setTags($tags)
    {
        $this->pushPayload->setTags($tags);
        return $this;
    }

    public function getExcludeTokens()
    {
        $this->pushPayload->getExcludeTokens();
    }

    public function setExcludeTokens($exclude_tokens)
    {
        $this->pushPayload->setExcludeTokens($exclude_tokens);
        return $this;
    }

    public function getScheduleFor()
    {
        $this->pushPayload->getScheduleFor();
    }

    public function setScheduleFor($scheduleFor)
    {
        $this->pushPayload->setScheduleFor($scheduleFor);
        return $this;
    }

    public function getAliases()
    {
        $this->pushPayload->getAliases();
    }

    public function setAliases($aliases)
    {
        $this->pushPayload->setAliases($aliases);
        return $this;
    }

    public function jsonSerialize()
    {
        $payload = array("aps" => $this->aps);
        $pushPayloadValues = $this->pushPayload->metadata;
        foreach ($pushPayloadValues as $key => $value){
            print "key" . $key . "\n" ;
            print  "value" . $value;
        }

        return $payload;
    }


}