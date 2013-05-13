<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/3/13
 * Time: 1:35 PM
 */

namespace UrbanAirship;


class UrbanAirshipApsPayload extends UrbanAirshipPayload
{
    const APS_ALERT_KEY = "alert";
    const APS_BADGE_KEY = "badge";
    const APS_SOUND_KEY = "sound";

    private $alert;
    private $badge;
    private $sound;

    public function __construct($alert=null, $badge=null, $sound=null)
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
       return $this->alert;
    }

    public function setAlert($alert)
    {
        $this->alert = $alert;
        return $this;
    }

    public function getSound()
    {
        return $this->sound;
    }

    public function setSound($sound)
    {
        $this->sound = $sound;
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

    public function metadata()
    {
        return array(self::APS_ALERT_KEY => $this->alert,
            self::APS_BADGE_KEY => $this->badge,
            self::APS_SOUND_KEY => $this->sound);
    }

    public function jsonSerialize()
    {
        $metadata = $this->metadata();
        return $this->removeNilValuesFromPayload($metadata);
    }

}