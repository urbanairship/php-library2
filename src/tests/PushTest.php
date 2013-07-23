<?php
/*
Copyright 2013 Urban Airship and Contributors
*/

require_once __DIR__ . "/../../vendor/autoload.php";

use UrbanAirship\Airship;
use UrbanAirship\Push as P;

class TestPushRequest extends PHPUnit_Framework_TestCase
{
    public function testSimplePushRequest()
    {
        $response = new StdClass();
        $response->code = 202;
        $response->raw_headers = array();
        $response->raw_body = "{\"push_ids\": [\"41742a47-bd36-4a0e-8ce2-866cd8f3b1b5\"]}";

        $airship = $this->getMock('Airship', array('request', 'buildUrl'));
        $airship->expects($this->any())
             ->method('request')
             ->will($this->returnValue($response));

        $push = new P\PushRequest($airship);
        $push = $push
            ->setAudience(P\all)
            ->setNotification(P\notification("Hello"))
            ->setDeviceTypes(P\all)
            ->setOptions(array());

        $response = $push->send();
    }
}
