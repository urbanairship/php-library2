<?php
/**
 * Created by PhpStorm.
 * User: invoked
 * Date: 2/19/2014
 * Time: 10:26 AM
 */
require_once __DIR__ . "/../../vendor/autoload.php";

use UrbanAirship\Airship;

class FeedbackDeviceTokenListTest extends PHPUnit_Framework_TestCase
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
		$response->raw_body='[
   {
      "device_token": "1234123412341234123412341234123412341234123412341234123412341234",
      "marked_inactive_on": "2009-06-22 10:05:00",
      "alias": "bob"
   },
   {
      "device_token": "ABCDABCDABCDABCDABCDABCDABCDABCDABCDABCDABCDABCDABCDABCDABCDABCD",
      "marked_inactive_on": "2009-06-22 10:07:00",
      "alias": null
   }
]';

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
		$list = $mockship->listFeedbackDeviceTokens();
		foreach($list as $dt)
		{
			$this->assertObjectHasAttribute('device_token', $dt);
			$this->assertObjectHasAttribute('marked_inactive_on', $dt);
			$this->assertObjectHasAttribute('alias', $dt);
		}

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
		$response->raw_body="[]";

		// Partial mock for airship, return the mocked response with the
		// prefab device list
		$mockship = $this->getMockBuilder('\UrbanAirship\Airship')
			->setConstructorArgs(array('key', 'secret'))
			->setMethods(array('request'))
			->getMock();
		$mockship->expects($this->any())
			->method('request')
			->will($this->returnValue($response));
		$list = $mockship->listFeedbackDeviceTokens();
		foreach($list as $dt)
		{
			$this->assertEmpty($dt);
		}

	}
} 