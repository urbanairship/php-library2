<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/3/13
 * Time: 10:52 AM
 */

namespace UrbanAirship;

require_once $_SERVER["UA_HANGER"].'/vendor/autoload.php';

class UrbanAirshipMetadata implements \JsonSerializable
{
    // Their are duplicate values in these constants, there is no guarantee
    // that matching keys will always stay that way.




    const REGISTRATION_PAYLOAD_TAGS_KEY = "tags";
    const REGISTRATION_PAYLOAD_ALIAS_KEY = "alias";
    const REGISTRATION_PAYLOAD_BADGE_KEY = "badge";
    const REGISTRATION_PAYLOAD_QUIET_TIME_KEY = "quiettime";
    const REGISTRATION_PAYLOAD_TIME_ZONE_KEY = "tz";
    const REGISTRATION_PAYLOAD_QUIET_TIME_START_KEY = "start";
    const REGISTRATION_PAYLOAD_QUIET_TIME_END_KEY = "end";


    protected  $metadata;

    public function  __constructor()
    {
        $this->metadata = array();
    }

    protected function setMetadata($key, $value)
    {
        $this->metadata[$key] = $value;
    }

    protected function getMetadata($key)
    {
        return $this->metadata[$key];
    }

    public function jsonSerialize()
    {
        return $this->metadata;
    }

}