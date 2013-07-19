<?php
/*
Copyright 2013 Urban Airship and Contributors
*/

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
