<?php
/*
Copyright 2013 Urban Airship and Contributors
*/

require_once __DIR__ . "/../../vendor/autoload.php";

use UrbanAirship\Push as P;

const dt = "ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff";

class TestAudience extends PHPUnit_Framework_TestCase
{
    public function testDeviceToken()
    {
        $this->assertEquals(P\deviceToken(dt), array("device_token" => dt));
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

    public function testAndroidUUID(){
        P\androidChannel("008b3f5b-5c30-467d-8885-03c3e1089999");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidIosUUID(){
        P\iosChannel("008b3f5b-5c30-467d-8885-foop");
    }

    public function testIosUUID(){
        P\iosChannel("008b3f5b-5c30-467d-8885-03c3e1089999");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidAmazonUUID(){
        P\amazonChannel("008b3f5b-5c30-467d-8885-foop");
    }

    public function testAmazonUUID(){
        P\amazonChannel("008b3f5b-5c30-467d-8885-03c3e1089999");
    }
}
