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

class TestPayload extends PHPUnit_Framework_TestCase
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
        $aps = IosMessagePayload::payload()
            ->setAlert($alert)
            ->setBadge($badge)
            ->setSound($sound);

        print_r(json_encode($aps));
    }

    public function testIosRegistration()
    {
        $payload = new IosRegistrationPayload();
        $payload->setAlias("alias")
            ->setBadge(1)
            ->setQuietTime("qt_start", "qt_end")
            ->setTimeZone("pancake_time");
        print_r(json_encode($payload, JSON_PRETTY_PRINT));
    }

}