<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/3/13
 * Time: 11:37 AM
 */

namespace UrbanAirship;

require_once $_SERVER["UA_HANGER"].'/vendor/autoload.php';

class UrbanAirshipIosRegistrationPayload extends UrbanAirshipMetadata
{



    public function getTags()
    {
        return $this->getMetadata(self::REGISTRATION_PAYLOAD_TAGS_KEY);
    }

    public function setTags($tags)
    {
        $this->setMetadata(self::REGISTRATION_PAYLOAD_TAGS_KEY, $tags);
    }

    public function getAlias()
    {
        return $this->getMetadata(self::REGISTRATION_PAYLOAD_ALIAS_KEY);
    }

    public function setAlias($alias)
    {
        $this->setMetadata(self::REGISTRATION_PAYLOAD_ALIAS_KEY, $alias);
    }

    public function getBadge()
    {
        return $this->getMetadata(self::REGISTRATION_PAYLOAD_BADGE_KEY);
    }

    public function setBadge($badge)
    {
        $this->setMetadata(self::REGISTRATION_PAYLOAD_BADGE_KEY, $badge);
    }

    public function getQuietTime()
    {
        return $this->getMetadata(self::REGISTRATION_PAYLOAD_QUIET_TIME_KEY);
    }

    public function setQuietTime($start, $end)
    {
        // TODO Verify quiet time is in the correct format
        $quietTime = array(
            self::REGISTRATION_PAYLOAD_QUIET_TIME_START_KEY => $start,
            self::REGISTRATION_PAYLOAD_QUIET_TIME_END_KEY => $end
        );
        $this->setMetadata(self::REGISTRATION_PAYLOAD_QUIET_TIME_KEY, $quietTime);
    }

    public function getTimeZone()
    {
        $this->getMetadata(self::REGISTRATION_PAYLOAD_TIME_ZONE_KEY);
    }

    public function setTimeZone($timeZone)
    {
        //TODO verify what format time zones take
        $this->setMetadata(self::REGISTRATION_PAYLOAD_TIME_ZONE_KEY, $timeZone);
    }
}