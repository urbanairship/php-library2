<?php
/*
Copyright 2013-2016 Urban Airship and Contributors
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

        $this->assertEquals(
            P\ios(
              "Hello iOS",
              "+1",
              "default",
              false,
              array("articleid" => "AB1234"),
              360,
              10,
              "news",
              array("type" => "ua_yes_no_foreground", "button_actions" => array(
                "yes" => array("add_tag" => "tapped_yes"), "no" => array("add_tag" => "tapped_no"))),
              true,
              array("url" => "https://media.giphy.com/media/JYsWwF82EGnpC/giphy.gif"),
              "Stuff"
           ),
            array(
                "alert" => "Hello iOS",
                "badge" => "+1",
                "sound" => "default",
                "extra" => array("articleid" => "AB1234"),
                "expiry" => 360,
                "priority" => 10,
                "category" => "news",
                "interactive" => array("type" => "ua_yes_no_foreground", "button_actions" => array("yes" => array("add_tag" => "tapped_yes"), "no" => array("add_tag" => "tapped_no"))),
                "mutable_content" => true,
                "media_attachment" => array("url" => "https://media.giphy.com/media/JYsWwF82EGnpC/giphy.gif"),
                "title" => "Stuff"
            ));

    }

    public function testAndroid()
    {
        $this->assertEquals(
            P\android("Hello", null, null, null, null, array("foo" => "bar")),
            array(
                "alert" => "Hello",
                "extra" => array("foo" => "bar")));

        $this->assertEquals(
            P\android(null, "collapseKey", 100, null, false, array("foo" => "bar")),
            array(
                "collapse_key" => "collapseKey",
                "time_to_live" => 100,
                "extra" => array("foo" => "bar")));

        $this->assertEquals(
            P\android(
              "Hello Android",
              null,
              null,
              null,
              false,
              array("articleid" => "AB1234"),
              array("type" => "big_text", "big_text" => "Holy moly, this is big!",
               "title" => "Holy bigness!", "summary" => "hi"),
              "Stuff", 
              null,
              "default",
              0,
              "alarm",
              null,
              null,
              false,
              array("interactive" => array("type" => "ua_yes_no_foreground", "button_actions" => array("yes" => array("add_tag" => "tapped_yes"), "no" => array("add_tag" => "tapped_no"))))
           ),
            array(
                "alert" => "Hello Android",
                "extra" => array("articleid" => "AB1234"),
                "style" => array("type" => "big_text", "big_text" => "Holy moly, this is big!",
               "title" => "Holy bigness!", "summary" => "hi"),
                "title" => "Stuff",
                "sound" => "default",
                "category" => "alarm",
                "wearable" => array("interactive" => array("type" => "ua_yes_no_foreground", "button_actions" => array("yes" => array("add_tag" => "tapped_yes"), "no" => array("add_tag" => "tapped_no"))))
                ));

    }

    public function testAmazon()
    {
        $this->assertEquals(
            P\amazon("Hello", null, null, null, null, array("foo" => "bar")),
            array(
                "alert" => "Hello",
                "extra" => array("foo" => "bar")));

        $this->assertEquals(
            P\amazon("Hello", "consolidationKey", 100, "NotificationTitle", "NotificationSummary", array("foo" => "bar"), array("type" => "big_text", "big_text" => "Holy moly, this is big!",
               "title" => "Holy bigness!", "summary" => "Big text"), "default"),
            array(
                "alert" => "Hello",
                "consolidation_key" => "consolidationKey",
                "expires_after" => 100,
                "title" => "NotificationTitle",
                "summary" => "NotificationSummary",
                "extra" => array("foo" => "bar"),
                "style" => array("type" => "big_text", "big_text" => "Holy moly, this is big!",
               "title" => "Holy bigness!", "summary" => "Big text"),
                "sound" => "default"));

    }

    public function testWns()
    {
        $this->assertEquals(
            P\wnsPayload("Hello"),
            array("alert" => "Hello"));

        $this->assertEquals(
            P\wnsPayload(null, "Toast"),
            array("toast" => "Toast"));

        $this->assertEquals(
            P\wnsPayload(null, null, "Tile"),
            array("tile" => "Tile"));

        $this->assertEquals(
            P\wnsPayload(null, null, null, "Badge"),
            array("badge" => "Badge"));
    }

    public function testMpns(){
        $this->assertEquals(
            P\mpnsPayload("Alert", "Toast", "Tile"),
            array('alert'=>"Alert",
                'toast'=>"Toast",
                'tile'=>"Tile"));

        $this->assertEquals(
            P\mpnsPayload("Alert", null, null),
            array('alert'=>"Alert"));
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
            P\deviceTypes("ios", "android", "amazon"),
            array("ios", "android", "amazon"));
    }

    public function testMessage()
    {
        $this->assertEquals(
            P\message("This is a title",
                "<html><body><h1>This is the messages</h1></body></html>",
                "text/html",
                "utf-8",
                0,
                array("offer_id"=>"608f1f6c-8860-c617-a803-b187b491568e"),
                array("list_icon"=>"http://cdn.example.com/message.png")
            ),
            array('title' => "This is a title",
                'body' => "<html><body><h1>This is the messages</h1></body></html>",
                'content_type' => "text/html",
                'content_encoding' => "utf-8",
                'expiry' => 0,
                'extra' => array("offer_id" => "608f1f6c-8860-c617-a803-b187b491568e"),
                'icons' => array("list_icon"=>"http://cdn.example.com/message.png")
            )
        );
    }

    public function testInAppMessage()
    {
      $this->assertEquals(
            P\inAppMessage("This is the alert text!",
                "banner",
                360,
                array("position"=>"top"),
                null,
                array("type" => "ua_yes_no_foreground", "button_actions" => array(
                "yes" => array("add_tag" => "tapped_yes"), "no" => array("add_tag" => "tapped_no"))),
                null
            ),
            array('alert' => "This is the alert text!",
                'display_type' => "banner",
                'expiry' => 360,
                'display' => array("position"=>"top"),
                'interactive' => array("type" => "ua_yes_no_foreground", "button_actions" => array("yes" => array("add_tag" => "tapped_yes"), "no" => array("add_tag" => "tapped_no")))
            )
        );
    }

    /**
     * @expectedException        InvalidArgumentException
     */
    public function testInvalidDeviceType()
    {
        P\deviceTypes("ios", "blackberry");
    }
}
