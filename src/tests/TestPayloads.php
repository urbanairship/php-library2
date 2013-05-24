<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/13/13
 * Time: 4:11 PM
 */

require_once __DIR__ . "/../../vendor/autoload.php";

use UrbanAirship\Push\Payload\IosMessagePayload;
use UrbanAirship\Push\Payload\IosRegistrationPayload;
use UrbanAirship\Push\Payload\AndroidMessagePayload;

class TestPayloads extends PHPUnit_Framework_TestCase
{

    protected $key;
    protected $secret;
    protected $token;
    protected $payload;

    protected function setUp()
    {
        $this->key = "key";
        $this->secret = "secret";
        $this->token = "token";
        $this->payload = array("payload" => "stuff");
    }

    public function testIosAps()
    {
        $alert = "alert";
        $badge = 42;
        $sound = "sound";
        $extras = array("extra" => "more things");
        $aps = IosMessagePayload::payload()
            ->setAlert($alert)
            ->setBadge($badge)
            ->setSound($sound)
            ->setExtras($extras);

        $json = json_encode($aps, JSON_PRETTY_PRINT);
        $jsonObject = json_decode($json);
        $this->assertTrue($jsonObject->{IosMessagePayload::APS_ALERT_KEY} === $alert);
        $this->assertTrue($jsonObject->{IosMessagePayload::APS_BADGE_KEY} === $badge);
        $this->assertTrue($jsonObject->{IosMessagePayload::APS_SOUND_KEY} === $sound);
        $this->assertTrue($jsonObject->extra === "more things");
    }

    public function testAndroidMessage()
    {
        $alert = "alert";
        $extras = array("extra" => "more things");
        $payload = AndroidMessagePayload::payload()
            ->setAlert($alert)
            ->setExtra($extras);
        $json = json_encode($payload);
        $jsonObject = json_decode($json);
        $this->assertTrue($jsonObject->{AndroidMessagePayload::ANDROID_ALERT_KEY} === $alert);
        $this->assertTrue($jsonObject->extra === "more things");
    }

    public function testIosRegistration()
    {
        $payload = new IosRegistrationPayload();
        $payload->setAlias("alias")
            ->setBadge(1)
            ->setQuietTime("qt_start", "qt_end")
            ->setTimeZone("pancake_time");
//        print_r(json_encode($payload, JSON_PRETTY_PRINT));
    }


}