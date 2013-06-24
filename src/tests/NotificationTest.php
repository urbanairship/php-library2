<?php

//    Copyright 2013 Urban Airship
//
//    Licensed under the Apache License, Version 2.0 (the "License");
//    you may not use this file except in compliance with the License.
//    You may obtain a copy of the License at
//
//    http://www.apache.org/licenses/LICENSE-2.0
//
//    Unless required by applicable law or agreed to in writing, software
//    distributed under the License is distributed on an "AS IS" BASIS,
//    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
//    See the License for the specific language governing permissions and
//    limitations under the License.

require_once __DIR__ . "/../../vendor/autoload.php";

use UrbanAirship\Push as P;

class TestNotification extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException        InvalidArgumentException
     */
    public function testEmptyNotificaiton()
    {
        P\notification();
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
}
