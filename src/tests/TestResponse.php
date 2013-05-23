<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/23/13
 * Time: 9:47 AM
 */

require_once __DIR__ . "/../../vendor/autoload.php";

use Httpful\Request;
use Httpful\Response;

use UrbanAirship\Push\Response\UAResponse;


class TestResponse extends PHPUnit_Framework_TestCase {

    public function testUAResponse()
    {
        $request = Request::get("http://www.google.com");
        $goodResponseHeaders = "Status: 200 OK\r\n\r\n";
        $goodResponseBody = "OK";

        $goodResponse = new Response($goodResponseBody, $goodResponseHeaders, $request);
        $testResponse = new UAResponse($goodResponse);
        $this->assertTrue($testResponse->getResponseCode() === 200,
            "Bad response code in UAResponse");
        $this->assertTrue($testResponse->getResponseBody() === $goodResponseBody,
            "Bad response body in UAResponse");

    }


    public function testUAResponseThrowsException()
    {
        // Set the expectation for an exception
        $this->setExpectedException('UrbanAirship\Push\Exception\UARequestException');
        $request = Request::get("http://www.google.com");

        $badResponseHeaders = "Status: 400 Bad Request\r\n\r\n";
        $badResponseBody = "Bad Request";
        $badResponse = new Response($badResponseBody, $badResponseHeaders, $request);
        $response = new UAResponse($badResponse);

    }
}