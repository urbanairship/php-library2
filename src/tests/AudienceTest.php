<?php
/*
Copyright 2013 Urban Airship and Contributors
*/

require_once __DIR__ . "/../../vendor/autoload.php";

use UrbanAirship\Push as P;

const dt = "ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff";
const uuid = "008b3f5b-5c30-467d-8885-03c3e1089999";

class TestAudience extends PHPUnit_Framework_TestCase
{
    public function testDeviceToken()
    {
        $this->assertEquals(
            P\deviceToken(dt), 
            array("device_token" => dt)
        );
    }

    public function testAndroidChannel()
    {
        $this->assertEquals(
            P\androidChannel(uuid), 
            array("android_channel" => uuid)
        );
    }

    public function testAmazonChannel()
    {
        $this->assertEquals(
            P\amazonChannel(uuid),
            array("amazon_channel" => uuid)
        );
    }

    public function testIosChannel()
    {
        $this->assertEquals(
            P\iosChannel(uuid),
            array("ios_channel" => uuid)
        );
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidDeviceToken()
    {
        P\deviceToken(dt . "more");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidUUID()
    {
        P\apid("008b3f5b-5c30-467d-8885-foop");
    }

    public function testUUID(){
        P\apid("008b3f5b-5c30-467d-8885-03c3e1089999");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidAndroidUUID(){
        P\androidChannel("008b3f5b-5c30-467d-8885-foop");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidIosUUID(){
        P\iosChannel("008b3f5b-5c30-467d-8885-foop");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidAmazonUUID(){
        P\amazonChannel("008b3f5b-5c30-467d-8885-foop");
    }
}
