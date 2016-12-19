<?php
/*
Copyright 2013-2016 Urban Airship and Contributors
*/

namespace UrbanAirship\Push;

use InvalidArgumentException;

const DEVICE_TOKEN_FORMAT = "/^[0-9a-fA-F]{64}$/";
const PIN_FORMAT = "/^[0-9a-fA-F]{8}$/";
const UUID_FORMAT =
    "/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}$/";

/**
    * Select all, to do a broadcast.
    *
    * Used in both `audience` and `deviceTypes`.
 */
CONST all = "all";

/**
    * Select a single iOS device token
    *
    * @param string $token
    * @return array
    * @throws \InvalidArgumentException
    */
function deviceToken($token)
{
    // This could return a non boolean false if there is an error
    if (preg_match(DEVICE_TOKEN_FORMAT, $token) == 0) {
        throw new InvalidArgumentException("Invalid iOS device token");
    }

    return array("device_token" => $token);
}

/**
    * Select a single Android APID
    * @param $uuid
    * @return array
    * @throws \InvalidArgumentException
    */
function apid($uuid)
{
    // This could return a non boolean false if there is an error
    if (preg_match(UUID_FORMAT, $uuid) == 0) {
        throw new InvalidArgumentException("Invalid APID");
    }

    return array("apid" => $uuid);
}

/**
    * Select a single Android Channel
    * @param $uuid
    * @return array
    * @throws \InvalidArgumentException
    */
function androidChannel($uuid)
{
    // This could return a non boolean false if there is an error
    if (preg_match(UUID_FORMAT, $uuid) == 0) {
        throw new InvalidArgumentException("Invalid Android Channel");
    }

    return array("android_channel" => $uuid);
}

/**
    * Select a single iOS Channel
    * @param $uuid
    * @return array
    * @throws \InvalidArgumentException
    */
function iosChannel($uuid)
{
    if(preg_match(UUID_FORMAT, $uuid) == 0){
        throw new InvalidArgumentException("Invalid iOS Channel");
    }

    return array("ios_channel" => $uuid);
}

/**
    * Select a single Amazon Channel
    * @param $uuid
    * @return array
    * @throws \InvalidArgumentException
    */
function amazonChannel($uuid){
    if(preg_match(UUID_FORMAT, $uuid) == 0){
        throw new InvalidArgumentException("Invalid Amazon Channel");
    }

    return array("amazon_channel" => $uuid);
}

/**
    * Select a single Windows 8 APID
    * @param $uuid
    * @return array
    * @throws \InvalidArgumentException
    */
function wns($uuid)
{
    // This could return a non boolean false if there is an error
    if (preg_match(UUID_FORMAT, $uuid) == 0) {
        throw new InvalidArgumentException("Invalid WNS");
    }

    return array("wns" => $uuid);
}

/**
    * Select a single Windows Phone 8 APID
    * @param $uuid
    * @return array
    * @throws \InvalidArgumentException
    */
function mpns($uuid)
{
    // This could return a non boolean false if there is an error
    if (preg_match(UUID_FORMAT, $uuid) == 0) {
        throw new InvalidArgumentException("Invalid MPNS");
    }

    return array("mpns" => $uuid);
}

/**
    * Select a single tag.
    * @param string $tag
*/
function tag($tag)
{
    return array("tag" => $tag);
}

/**
    * Select a single alias.
    * @param string $alias
*/
function alias($alias)
{
    return array("alias" => $alias);
}

/**
    * Select a single named user.
    * @param string $namedUser
*/
function namedUser($namedUser)
{
    return array("named_user" => $namedUser);
}

/**
    * Select a single segment.
    * @param string $segment
*/
function segment($segment)
{
    return array("segment" => $segment);
}

// Compound selectors

/**
    * Select an audience that matches one of the given selectors.
    *
    * Pass in any number of selectors as arguments.
*/
function or_()
{
    return array("or" => func_get_args());
}

/**
    * Select an audience that matches all of the given selectors.
    *
    * Pass in any number of selectors as arguments.
*/
function and_()
{
    return array("and" => func_get_args());
}

/**
    * Select audience members that do not match the given selector.
    * @param $child
*/
function not_($child)
{
    return array("not" => $child);
}

// Location

/**
    * Select a location expression.
    *
    * Location expressions are made up of either an id or an alias and a time
    * period specifier. Use one of the date specifier functions to return a
    * properly formatted time specifier
    *
    * @param $date A date range specifier, created by either `recentDate` or `absoluteDate`.
    * @param array $locationOpts An array containing either id and value, or an 
    *   alias and value, e.g. `array("id"=>"4oFkxX7RcUdirjtaenEQIV")` or 
    *   `array("us_zip": "94103")`.
    * @return array
    */
function location($date, array $locationOpts)
{
    return array("location" => array_merge(array("date" => $date),
        $locationOpts));
}

/**
    * Checks to see if the supplied resolution matches an allowable resolution
    * Allowed resolutions:
    *
    * minutes
    * hours
    * days
    * weeks
    * months
    * years
    *
    * @param $resolution
    * @return bool
    */
function acceptableResolution($resolution)
{
    $acceptableValues = array("minutes", "hours", "days", "weeks", "months",
        "years");
    if (array_search($resolution, $acceptableValues) == false) {
        return false;
    } else {
        return true;
    }
}

/**
    * Produces a time specifier that represents relative amount of time, such
    * as "the past three days"
    *
    * @param $resolution string Valid time resolution, e.g. `minutes` or `weeks`.
    * @param $lengthOfTime string Amount of time
    * @return array
    * @throws \InvalidArgumentException If the resolution is not recognized
    */
function recentDate($resolution, $lengthOfTime)
{
    if (!acceptableResolution($resolution)) {
        throw new InvalidArgumentException("Invalid date resolution");
    }
    $payload = array("recent" => array($resolution => $lengthOfTime));
    
    return $payload;
}

/**
    * Produces a time specifier that represents an absolute amount of time,
    * such as from 2012-01-01 12:00 to 2012-01-01 12:00
    * @param $resolution string Valid time resolution
    * @param $start string Beginning of absolute window
    * @param $end string End of absolute window
    * @return array
    * @throws \InvalidArgumentException
    */
function absoluteDate($resolution, $start, $end)
{
    if (!acceptableResolution($resolution)) {
        throw new InvalidArgumentException("Invalid date resolution");
    }
    $resolutionPayload = array($resolution => array("start" => $start,
        "end" => $end));

    return array("date" => $resolutionPayload);
}
