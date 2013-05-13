<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/3/13
 * Time: 11:37 AM
 */

namespace UrbanAirship\Push\Payload;


class IosRegistrationPayload extends Payload
{

    const REGISTRATION_PAYLOAD_TAGS_KEY = "tags";
    const REGISTRATION_PAYLOAD_ALIAS_KEY = "alias";
    const REGISTRATION_PAYLOAD_BADGE_KEY = "badge";
    const REGISTRATION_PAYLOAD_QUIET_TIME_KEY = "quiettime";
    const REGISTRATION_PAYLOAD_TIME_ZONE_KEY = "tz";
    const REGISTRATION_PAYLOAD_QUIET_TIME_START_KEY = "start";
    const REGISTRATION_PAYLOAD_QUIET_TIME_END_KEY = "end";

    private $alias;
    private $tags;
    private $badge;
    private $quietTime;
    private $timeZone;

    public function getAlias()
    {
        return $this->alias;
    }

    public function setAlias($alias)
    {
        $this->alias = $alias;
        return $this;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setTags($tags)
    {
        if (is_array($tags)){
            $this->tags = $tags;
        }
        else {
            $this->tags = array($tags);
        }
        return $this;
    }

    public function getBadge()
    {
        return $this->badge;
    }

    public function setBadge($badge)
    {
        $this->badge = $badge;
        return $this;
    }

    public function getQuietTime()
    {
        return $this->quietTime;
    }

    public function setQuietTime($start, $end)
    {
        // TODO Verify quiet time is in the correct format
        $quietTime = array(
            self::REGISTRATION_PAYLOAD_QUIET_TIME_START_KEY => $start,
            self::REGISTRATION_PAYLOAD_QUIET_TIME_END_KEY => $end
        );
        $this->quietTime = $quietTime;
        return $this;
    }

    public function getTimeZone()
    {
        return $this->timeZone;
    }

    public function setTimeZone($timeZone)
    {
        //TODO verify what format time zones take
        $this->timeZone = $timeZone;
        return $this;
    }

    /**
     * Return the metadata for this object as an array suitable for use as a
     * JSON object
     */
    public function metadata()
    {
        $payload = array(
            self::REGISTRATION_PAYLOAD_TAGS_KEY => $this->tags,
            self::REGISTRATION_PAYLOAD_ALIAS_KEY => $this->alias,
            self::REGISTRATION_PAYLOAD_BADGE_KEY => $this->badge,
            self::REGISTRATION_PAYLOAD_QUIET_TIME_KEY => $this->quietTime,
            self::REGISTRATION_PAYLOAD_TIME_ZONE_KEY => $this->timeZone
        );

        return $this->removeNilValuesFromPayload($payload);
    }

    public function jsonSerialize()
    {
        return $this->metadata();
    }

}