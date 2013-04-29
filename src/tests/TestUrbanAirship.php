<?php

require_once("../UrbanAirship.php");
/**
 * Created by IntelliJ IDEA.
 * User: mhooge
 * Date: 4/26/13
 * Time: 3:04 PM
 * To change this template use File | Settings | File Templates.
 */

class TestUrbanAirship extends PHPUnit_Framework_TestCase
{
    public function testFailure()
    {
        $url = UrbanAirship::getBaseUrl();
        $this->assertTrue(strcmp($url, "http://go.urbanairship.com/api") == 0);
    }
}
