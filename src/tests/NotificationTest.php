<?php
/*
Copyright 2013 Urban Airship and Contributors
*/

require_once __DIR__ . "/../../vendor/autoload.php";

use UrbanAirship\Push as P;

class TestNotification extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException        InvalidArgumentException
     */
    public function testEmptyNotificaiton()
    {
        P\notification(null);
    }

    public function testSimpleAlert()
    {
        $this->assertEquals(
            P\notification("Hi"), array("alert" => "Hi"));
    }

    public function testIos()
    {
        $this->assertEquals(
            P\ios("Hello", 100, null, false, array("foo" => "bar")),
            array(
                "alert" => "Hello",
                "badge" => 100,
                "extra" => array(
                    "foo" => "bar")));

        $this->assertEquals(
            P\ios(null, "+1", null, true,
                array("foo" => array("bar" => "baz"))),
            array(
                "badge" => "+1",
                "content_available" => true,
                "extra" => array(
                    "foo" => 
                        array("bar" => "baz"))));
        $this->assertEquals(
            P\ios(null, "auto"),
            array("badge" => "auto"));
    }

    /**
     * @expectedException        InvalidArgumentException
     */
    public function testInvalidBadgeBadAutobadge()
    {
        P\ios(null, "+NaN");
    }

    /**
     * @expectedException        InvalidArgumentException
     */
    public function testInvalidBadgeBadString()
    {
        P\ios(null, "NaN");
    }

    /**
     * @expectedException        InvalidArgumentException
     */
    public function testInvalidBadgeIntegerAsString()
    {
        P\ios(null, "45");
    }

    /**
     * @expectedException        InvalidArgumentException
     */
    public function testInvalidBadgeType()
    {
        P\ios(null, true);
    }

    public function testDeviceTypes()
    {
        $this->assertEquals(
            P\deviceTypes("ios"),
            array("ios"));
        $this->assertEquals(
            P\deviceTypes("ios", "android"),
            array("ios", "android"));
    }

    /**
     * @expectedException        InvalidArgumentException
     */
    public function testInvalidDeviceType()
    {
        P\deviceTypes("ios", "symbian");
    }
}
