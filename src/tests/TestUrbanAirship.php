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

        $this->assertTrue(strcmp($request->getUrl(), $url) == 0);
        $auth_headers = $request->getAuth();
        print_r($auth_headers);
        $this->assertTrue(strcmp($auth_headers['user'], $user) == 0);
        $this->assertTrue(strcmp($auth_headers['password'], $pass) == 0);
        $this->assertTrue(strcmp($auth_headers['scheme'],
            HTTP_Request2::AUTH_BASIC ) == 0);


    }
}
