<?php
/*
Copyright 2013 Urban Airship and Contributors
*/

require_once __DIR__ . "/../../vendor/autoload.php";

use UrbanAirship\Airship;
use UrbanAirship\AirshipException;

class TestAirship extends PHPUnit_Framework_TestCase
{
    public function testRequest()
    {
        $response = new StdClass();
        $response->code = 200;
        $response->raw_headers = array();
        $response->raw_body = "OK";
        $request = $this->getMock('StdClass', array('method', 'uri', 'authenticateWith', 'body', 'addHeaders', 'send'));
        $request->expects($this->any())->method('method')->will($this->returnValue($request));
        $request->expects($this->any())->method('uri')->will($this->returnValue($request));
        $request->expects($this->any())->method('authenticateWith')->will($this->returnValue($request));
        $request->expects($this->any())->method('body')->will($this->returnValue($request));
        $request->expects($this->any())->method('addHeaders')->will($this->returnValue($request));
        $request->expects($this->any())
             ->method('send')
             ->will($this->returnValue($response));

        $airship = new Airship("key", "secret");
        $this->assertEquals(
            $airship->request("POST", "some_data", "http://example.com/", "text/plain", 3, $request),
            $response);

    }

    /**
     * @expectedException UrbanAirship\AirshipException
     */
    public function testFailedRequest()
    {
        $request = $this->getMock('StdClass', array('method', 'uri', 'authenticateWith', 'body', 'addHeaders', 'send'));
        $request->method = 'POST';
        $request->uri = 'http://example.com/';

        $response = new StdClass();
        $response->code = 400;
        $response->raw_headers = array();
        $response->raw_body = "{\"error\": \"Bad Request\", \"error_code\": \"40000\", \"details\": \"Oops!\"}";
        $response->request = $request;

        $request->expects($this->any())->method('method')->will($this->returnValue($request));
        $request->expects($this->any())->method('uri')->will($this->returnValue($request));
        $request->expects($this->any())->method('authenticateWith')->will($this->returnValue($request));
        $request->expects($this->any())->method('body')->will($this->returnValue($request));
        $request->expects($this->any())->method('addHeaders')->will($this->returnValue($request));
        $request->expects($this->any())
             ->method('send')
             ->will($this->returnValue($response));

        $airship = new Airship("key", "secret");
        $airship->request("POST", "some_data", "http://example.com/", "text/plain", 3, $request);
    }

    public function testBuildUrl()
    {
        $airship = new Airship("key", "secret");
        $this->assertEquals(
            $airship->buildUrl("/api/test/"),
            "https://go.urbanairship.com/api/test/");
        $this->assertEquals(
            $airship->buildUrl("/api/test/", array("foo"=>"bar", "baz"=>"ack")),
            "https://go.urbanairship.com/api/test/?foo=bar&baz=ack");
    }
}
