<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/3/13
 * Time: 1:35 PM
 */

namespace UrbanAirship\Push\Payload;

class IosMessagePayload extends Payload
{
    const APS_ALERT_KEY = "alert";
    const APS_BADGE_KEY = "badge";
    const APS_SOUND_KEY = "sound";

    private $alert;
    private $badge;
    private $sound;
    private $extras;

    protected function __constructor(){}

    /**
     * An object that complies with the JsonSerializable interface that
     * is appended to the message payload.
     * @param $extras mixed Additional key value pairs for the massage.
     * @return $this
     */
    public function setExtras($extras)
    {
        $this->extras = $extras;
        return $this;
    }

    /**
     * Extras set for this message payload
     * @return mixed Current extras
     */
    public function getExtras()
    {
        return $this->extras;
    }

    /**
     * Current alert
     * @return string
     */
    public function getAlert()
    {
       return $this->alert;
    }

    /**
     * @param $alert string New alert for this message
     * @return $this
     */
    public function setAlert($alert)
    {
        $this->alert = $alert;
        return $this;
    }

    /**
     * File name for on device notification sound.
     * @return string Current file name for the sound
     */
    public function getSound()
    {
        return $this->sound;
    }

    /**
     * The current setting for the on device sound file
     * @param $sound string File name for sound
     * @return $this
     */
    public function setSound($sound)
    {
        $this->sound = $sound;
        return $this;
    }

    /**
     * Badge value for this message
     * @return mixed
     */
    public function getBadge()
    {
        return $this->badge;
    }

    /**
     * Sets the badge value for the device. If autobadge is used, this can be
     * used to increment the value.
     * <code>
     *  $payload->setBadge(+1) // This will increment the current badge value
     *                         // by one
     * </code>
     * @param $badge mixed Badge value
     * @return $this
     */
    public function setBadge($badge)
    {
        $this->badge = $badge;
        return $this;
    }

    /**
     * Produce an array that can be converted to JSON for the payload
     * @return array
     */
    public function metadata()
    {
        $payload = array(self::APS_ALERT_KEY => $this->alert,
            self::APS_BADGE_KEY => $this->badge,
            self::APS_SOUND_KEY => $this->sound);
        if (!is_null($this->extras)){
            $payload = array_merge($payload, $this->extras);
        }
        return $payload;
    }

    /**
     * Returns a new IosMessagePayload object
     * @return IosMessagePayload
     */
    public static function payload()
    {
        return new IosMessagePayload();
    }

    public function jsonSerialize()
    {
        $metadata = $this->metadata();
        return $this->removeNilValuesFromPayload($metadata);
    }


}