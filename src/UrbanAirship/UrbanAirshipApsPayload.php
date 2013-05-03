<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/3/13
 * Time: 1:35 PM
 */

namespace UrbanAirship;

require_once $_SERVER["UA_HANGER"].'/vendor/autoload.php';

class UrbanAirshipApsPayload extends UrbanAirshipMetadata
{

    public function __constructor($alert=null, $badge=null, $sound=null)
    {
        if ($alert != null)
        {
            $this->setAlert($alert);
        }
        if ($badge != null)
        {
            $this->setBadge($badge);
        }
        if ($sound != null)
        {
            $this->setSound($sound);
        }

    }

    public function getAlert()
    {
       return $this->getMetadata(self::APS_ALERT_KEY);
    }

    public function setAlert($alert)
    {
        $this->setMetadata(self::APS_ALERT_KEY, $alert);
    }

    public function getSound()
    {
        return $this->getMetadata(self::APS_SOUND_KEY);
    }

    public function setSound($sound)
    {
        $this->setSound(self::APS_SOUND_KEY, $sound);
    }

    public function getBadge()
    {
        return $this->getMetadata(self::APS_BADGE_KEY);
    }

    public function setBadge($badge)
    {
        $this->setMetadata(self::APS_BADGE_KEY, $badge);
    }

    public function jsonSerialize()
    {
        return $this->metadata;
    }

}