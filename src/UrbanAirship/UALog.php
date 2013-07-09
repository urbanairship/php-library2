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

namespace UrbanAirship;

use Monolog\Logger;

/**
 * Logging class
 * Class UALog
 * @package UrbanAirship\Push\Log
 */
class UALog {

    const DEFAULT_UA_LOG_NAME = "UrbanAirship";

    private static $logHandlers;

    /**
     * Add log handlers to tailor logging for your use case. Default logging
     * is the Monolog default, a Monolog StreamHandler('php://stderr', static::DEBUG)
     * Use Monolog NullHandler to disable all logging.
     * @param $handlers
     */
    public static function setLogHandlers($handlers)
    {
        self::$logHandlers = $handlers;
    }

    /**
     * Get the current log handler array
     * @return mixed
     */
    public static function getLogHandlers()
    {
        return self::$logHandlers;
    }

    /**
     * Returns the logger for standard logging in the library
     * @return Logger
     */
    public static function getLogger()
    {
        if (!self::$logHandlers) {
            self::setLogHandlers(array());
        }
        return new Logger(self::DEFAULT_UA_LOG_NAME, self::$logHandlers);
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
            $logLine = sprintf("%sBody:%s\n", $logLine, json_encode($request->payload));
        }
        return $logLine;
    }


}
