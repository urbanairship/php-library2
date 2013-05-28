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

namespace UrbanAirship\Push\Url;

class IosUrl extends Url
{
    /**
     * @var string $$DEVICE_TOKEN_PATH Device Token Path.
     */
    private static $DEVICE_TOKEN_PATH = "device_tokens";

    private static $FEEDBACK_PATH = "feedback";

    private static $FEEDBACK_QUERY_PARAM = "?since=";


    /**
     * @return string Device token path for URL
     */
    protected  static function deviceTokenPath()
    {
        return self::$DEVICE_TOKEN_PATH;
    }

    public static function iosRegistration($deviceToken)
    {
        return self::appendPathComponentsToURL(self::urbanAirshipBaseApiUrl(),
            array(self::$DEVICE_TOKEN_PATH, $deviceToken));
    }

    public static function iosDeviceInformation($deviceToken)
    {
        return IosUrl::iosRegistration($deviceToken);
    }

    public static function iosDeviceTokenList()
    {
        return self::appendPathComponentsToURL(self::$BASE_URL,
            array(self::$DEVICE_TOKEN_PATH));
    }

    public static function iosFeedbackSince($isoDateString)
    {
        $query = self::$FEEDBACK_QUERY_PARAM;
        $timeQuery = "{$query}{$isoDateString}";
        return self::appendPathComponentsToURL(self::$BASE_URL,
            array(self::$DEVICE_TOKEN_PATH,
                self::$FEEDBACK_PATH,
                $timeQuery));
    }

}