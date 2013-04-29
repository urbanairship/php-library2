<?php

require_once "../UrbanAirship.php";
require_once "../RESTClient.php";
require_once "HTTP/Request2.php";
/**
 * Created by IntelliJ IDEA.
 * User: mhooge
 * Date: 4/26/13
 * Time: 3:04 PM
 * To change this template use File | Settings | File Templates.
 */

class TestUrbanAirship extends PHPUnit_Framework_TestCase
{
    public function testBasicAuthRequest()
    {
        $url = "url";
        $user = "user";
        $pass = "pass";
        $request = RESTClient::createBasicAuthRequest(HTTP_Request2::METHOD_GET,
            $url,
            $user,
            $pass);

        $this->assertNotNull($request);
    }
}
