<?php
//    Copyright 2012 Urban Airship
//
//    Licensed under the Apache License, Version 2.0 (the "License");
//    you may not use this file except in compliance with the License.
//    You may obtain a copy of the License at
//
//    http://www.apache.org/licenses/LICENSE-2.0
//
//    Unless required by applicable law or agreed to in writing, software
//    distributed under the License is distributed on an "AS IS" BASIS,
//    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
//    See the License for the specific language governing permissions and
//    limitations under the License.

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