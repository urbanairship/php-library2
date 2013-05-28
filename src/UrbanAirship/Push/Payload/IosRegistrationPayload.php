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
 * Data model for iOS registrations
 * Class IosRegistrationPayload
 * @package UrbanAirship\Push\Payload
 */
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

    protected function __construct(){}

    /**
     * Create a new IosRegistrationPayload.
     * @return IosRegistrationPayload
     */
    public static function payload()
    {
        return new IosRegistrationPayload();
    }

    /**
     * Current alias for this registration.
     * @return mixed
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Aliases for this device
     * @param $alias
     * @return $this
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * Current tags
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Tags for this device
     * @param $tags
     * @return $this
     */
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

    /**
     * Badge value for this registration.
     * @return mixed
     */
    public function getBadge()
    {
        return $this->badge;
    }

    /**
     * Set a new badge value for this registration. This will replace the
     * badge value on the server with this value.
     * @param $badge
     * @return $this
     */
    public function setBadge($badge)
    {
        $this->badge = $badge;
        return $this;
    }

    /**
     * Returns the quiet time values for this registration. The time is
     * an array with a start/end time
     *
     * <code>
     * Array
     *  (
     *     [start] => 7:00
     *      [end] => 22:00
     *  )
     * </code>
     *
     * @return array
     */
    public function getQuietTime()
    {
        return $this->quietTime;
    }

    /**
     * Set a quiet time range, expects start and end to be in 24 format.
     * @param $start
     * @param $end
     * @return $this
     */
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

    /**
     * Get the current time zone for this registration.
     * @return string.
     */
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

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return $this->metadata();
    }


}