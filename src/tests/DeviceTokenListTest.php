<?php
/*
Copyright 2013 Urban Airship and Contributors
*/

require_once __DIR__ . "/../../vendor/autoload.php";

use UrbanAirship\Airship;

class TestDeviceTokenList extends PHPUnit_Framework_TestCase
{
    /*
     * Handles single page response
     */
    public function testListsSinglePage()
    {
        $response = new StdClass();
        $response->code=200;
        $response->raw_headers = array();
        // Only build an array of strings to iterate through, we care about iteration
        // not specifics of the data being iterated.
        $response->raw_body="{\"device_tokens\": [\"foo\",\"bar\"],\"device_tokens_count\": 3,\"active_device_tokens_count\": 3}";

        // Partial mock for airship, return the mocked response with the
        // prefab device list
        $mockship = $this->getMockBuilder('\UrbanAirship\Airship')
            ->setConstructorArgs(array('key', 'secret'))
            ->setMethods(array('request'))
            ->getMock();
        $mockship->expects($this->any())
            ->method('request')
            ->will($this->returnValue($response));

        //ignore intellij warning here, mock class forwards the message
        $list = $mockship->listDeviceTokens();
        $test_array = array();
        foreach($list as $dt)
        {
            array_push($test_array, $dt);
        }
        array_key_exists('foo', $test_array);
        array_key_exists('bar', $test_array);
    }

    /*
     * Handles empty list
     */
    public function testListEmptyPage()
    {
        $response = new StdClass();
        $response->code=200;
        $response->raw_headers = array();
        // Return an empty array
        $response->raw_body="{\"device_tokens\": [],\"device_tokens_count\": 0,
        \"active_device_tokens_count\": 3}";

        // Partial mock for airship, return the mocked response with the
        // prefab device list
        $mockship = $this->getMockBuilder('\UrbanAirship\Airship')
            ->setConstructorArgs(array('key', 'secret'))
            ->setMethods(array('request'))
            ->getMock();
        $mockship->expects($this->any())
            ->method('request')
            ->will($this->returnValue($response));
        $list = $mockship->listDeviceTokens();
        $test_array = array();
        foreach($list as $dt)
        {
            array_push($test_array, $dt);
        }
        $this->assertEmpty($test_array);
    }

    public function testMultiPageList()
    {
        // Stub the two responses
        $listResponse = new StdClass();
        $listResponse->code=200;
        $listResponse->raw_headers = array();
        $listResponse->raw_body =
            "{\"device_tokens\": [\"foo\",\"bar\"],\"device_tokens_count\": 2," .
            "\"active_device_tokens_count\": 3, \"next_page\":\"foo\"}";

        $emptyResponse = new StdClass();
        $emptyResponse->code=200;
        $emptyResponse->raw_headers = array();
        // Return an empty array
        $emptyResponse->raw_body =
            "{\"device_tokens\": [\"baz\"],\"device_tokens_count\": 1,".
            "\"active_device_tokens_count\": 3}";

        // Partial mock for airship, return the mocked response with the
        // prefab device list, setup both calls
        $mockship = $this->getMockBuilder('\UrbanAirship\Airship')
            ->setConstructorArgs(array('key', 'secret'))
            ->setMethods(array('request'))
            ->getMock();
        $mockship->expects($this->exactly(2))
            ->method('request')
            ->will($this->onConsecutiveCalls($listResponse, $emptyResponse));

        $list = $mockship->listDeviceTokens();
        $test_array = array();
        foreach($list as $dt)
        {
            array_push($test_array, $dt);
        }
        array_key_exists('foo', $test_array);
        array_key_exists('bar', $test_array);
        array_key_exists('baz', $test_array);
    }
}