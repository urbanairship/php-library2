<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/15/13
 * Time: 10:53 AM
 */

require_once __DIR__ . "/../../vendor/autoload.php";

use UrbanAirship\Push\Url\IosUrl;

class TestUrls extends PHPUnit_Framework_TestCase
{
    public function testFeedbackUrl()
    {
        $date = new DateTime("12/23/1976");
        $dateString =  date (DATE_ISO8601, $date->getTimestamp());
        $expected =  "https://go.urbanairship.com/api/device_tokens/feedback/?since={$dateString}/";
        $url = IosUrl::iosFeedbackSince(date(DATE_ISO8601,
            $date->getTimestamp()));
        $this->assertTrue($expected === $url);
    }
}