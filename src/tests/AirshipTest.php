<?php
/*
Copyright 2013 Urban Airship and Contributors
*/

require_once __DIR__ . "/../../vendor/autoload.php";

ini_set('error_reporting', 2147483647);
ini_set('display_errors', '1');

use UrbanAirship\Airship;
use UrbanAirship\AirshipException;

class TestAirship extends PHPUnit_Framework_TestCase
{
    public function testRequest()
    {
        $response_code = 200;
        $response_raw_headers = "HTTP/1.1 200 OK\nContent-Type: application/json";
        $response_raw_body = 'Test Airship OK';

        $request = $this->getMock('MX\RestManager');
        $request->expects($this->once())->method('setHeaders')->will($this->returnValue(true));
        $request->expects($this->once())->method('post')->will($this->returnValue($response_raw_body));
        $request->expects($this->exactly(4))->method('response')
                ->will($this->onConsecutiveCalls($response_code,
                                                 $response_raw_headers,
                                                 $response_raw_body,
                                                 $response_code));
        
        $airship = new Airship('key', 'secret');
        $this->assertEquals(
            $airship->request('POST', 'some_data', 'http://example.com/', 'text/plain', 3, $request),
            $response_raw_body
        );
    }

    /**
     * @expectedException UrbanAirship\AirshipException
     */
    public function testFailedRequest()
    {
        $response_code = 400;
        $response_raw_headers = "HTTP/1.1 400 Bad Request\nContent-Type: application/json";
        $response_raw_body = "{\"error\": \"Bad Request\", \"error_code\": \"40000\", \"details\": \"Oops!\"}";

        $request = $this->getMock('MX\RestManager');
        $request->expects($this->once())->method('setHeaders')->will($this->returnValue(true));
        $request->expects($this->once())->method('post')->will($this->returnValue($response_raw_body));
        $request->expects($this->exactly(7))->method('response')
                ->will($this->onConsecutiveCalls($response_code,
                                                 $response_raw_headers,
                                                 $response_raw_body,
                                                 $response_code,
                                                 $response_raw_body,
                                                 $response_raw_body,
                                                 $response_code));
        $request->expects($this->once())->method('lastResUrl')->will($this->returnValue('http://example.com/'));
        
        $airship = new Airship('key', 'secret');
        $airship->request('POST', 'some_data', 'http://example.com/', 'text/plain', 3, $request);
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
