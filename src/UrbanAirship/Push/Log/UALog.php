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

namespace UrbanAirship\Push\Log;

use Monolog\Logger;

/**
 * Logging class
 * Class UALog
 * @package UrbanAirship\Push\Log
 */
class UALog {

    const DEFAULT_UA_LOG_NAME = "com.urbanairship.uaphp";

    /**
     * Returns the logger for standard logging in the library
     * @return Logger
     */
    public static function getLogger()
    {
        return new Logger(self::DEFAULT_UA_LOG_NAME);
    }

    /**
     * Parse the components of the request into a string for consistent
     * log statements
     * @param $request
     * @return string
     */
    public static function debugLogForRequest($request)
    {
        $logLine = sprintf("\nUA PHP Request\n URL:%s\n", $request->uri);
        if (!empty($request->headers)){
            $headerString = implode("|", $request->headers);
            $logLine = sprintf("%sHeaders:%s\n", $logLine, $headerString);
        }
        if (!is_null($request->payload)){
            $logLine = sprintf("%sBody:%s\n", $logLine, json_encode($request->payload, JSON_PRETTY_PRINT));
        }
        return $logLine;
    }


}