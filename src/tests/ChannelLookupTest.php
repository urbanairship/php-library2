<?php
/*
Copyright 2013-2016 Urban Airship and Contributors
*/

require_once __DIR__ . "/../../vendor/autoload.php";

use UrbanAirship\Airship;

class TestChannelLookup extends PHPUnit_Framework_TestCase
{

	public function testLookupChannel() {
		$response = new StdClass();
        $response->code=200;
        $response->raw_headers = array();
        $channel_string ='{"channel_id":"905c322e-10de-4786-aacb-40126a55d0c7","device_type":"ios","installed":true}';
        $response->raw_body = json_decode(json_encode($channel_string), true);

        // Partial mock for airship, return the mocked response with the
        // prefab device
        $mockship = $this->getMockBuilder('\UrbanAirship\Airship')
            ->setConstructorArgs(array('key', 'secret'))
            ->setMethods(array('request'))
            ->getMock();
        $mockship->expects($this->any())
            ->method('request')
            ->will($this->returnValue($response));

        $chan_id = "905c322e-10de-4786-aacb-40126a55d0c7";
        $chan = $mockship->channelLookup($chan_id)
        	->channelInfo();

        // Just want to test a few key/value pairs to ensure lookup is working
        $this->assertSame($chan->channel_id, "905c322e-10de-4786-aacb-40126a55d0c7");
        $this->assertSame($chan->device_type, "ios");
        $this->assertSame($chan->installed, true);
	}

	public function testNullChannel() {
        $response = new StdClass();
        $response->code=200;
        $response->raw_headers = array();
        // Return an empty array
        $response->raw_body="{}";

        // Partial mock for airship, return the mocked response with the
        // prefab device list
        $mockship = $this->getMockBuilder('\UrbanAirship\Airship')
            ->setConstructorArgs(array('key', 'secret'))
            ->setMethods(array('request'))
            ->getMock();
        $mockship->expects($this->any())
            ->method('request')
            ->will($this->returnValue($response));

        $chan = $mockship->channelLookup("")
            ->channelInfo();
        $this->assertEmpty($chan);
	}

}