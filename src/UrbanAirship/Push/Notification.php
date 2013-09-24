<?php
/*
Copyright 2013 Urban Airship and Contributors
*/

namespace UrbanAirship\Push;

use InvalidArgumentException;

const AUTOBADGE_FORMAT = "/^(auto)|([+-][0-9]+)$/";

/**
 * Creates a notification payload.
 *
 * @param $alert string Global alert for all device types. Use null for no alert.
 * @param $overrides array Optional array of platform overrides.
 * @return array
 * @throws \InvalidArgumentException If result payload is empty.
 */
function notification($alert, $overrides=array())
{
    $payload = array();
    if ($alert != null) {
        $payload["alert"] = $alert;
    }
    $payload = array_merge($payload, $overrides);
    if (count($payload) == 0) {
        throw new InvalidArgumentException("Notification cannot be empty");
    }

    return $payload;
}

/**
 * iOS/APNS specific platform override payload.
 *
 * @param $alert string|array: iOS format alert.
 * @param $badge int|string: An integer badge value or an autobadge string.
 * @param $sound string: A sound file to play.
 * @param $contentAvailable bool: If true, pass on the content_available command
 * for Newsstand iOS applications.
 * @param $extra array: A set of key/value pairs to include in the push payload
 * sent to the device.
 * @return array
 * @throws \InvalidArgumentException for invalid values.
 */
function ios($alert=null, $badge=null, $sound=null, $contentAvailable=false,
        $extra=null)
{
    $payload = array();
    if (!is_null($alert)) {
        $payload["alert"] = $alert;
    }
    if (!is_null($badge)) {
        if (is_string($badge)) {
            if (preg_match(AUTOBADGE_FORMAT, $badge) === 0) {
                throw new InvalidArgumentException("Invalid autobadge string");
            }
        } elseif (!is_int($badge)) {
            throw new InvalidArgumentException("Invalid badge type");
        }
        $payload["badge"] = $badge;
    }
    if (!is_null($sound)) {
        $payload["sound"] = $sound;
    }
    if ($contentAvailable) {
        $payload["content_available"] = true;
    }
    if (!is_null($extra)) {
        $payload["extra"] = $extra;
    }

    return $payload;
}

/**
 * Android specific platform override payload.
 *
 * @link http://developer.android.com/google/gcm/adv.html GCM Advanced Topics
 * for details on `collapseKey`, `timeToLive`, and `delayWhileIdle`.
 *
 * @param $alert string|null
 * @param $collapseKey
 * @param $timeToLive
 * @param $delayWhileIdle
 * @param $extra array | A set of key/value pairs to include in the push payload
 * sent to the device.
 * @return array
 */
function android($alert=null, $collapseKey=null, $timeToLive=null,
    $delayWhileIdle=null, $extra=null)
{
    $payload = array();
    if (!is_null($alert)) {
        $payload["alert"] = $alert;
    }
    if (!is_null($collapseKey)) {
        $payload["collapse_key"] = $collapseKey;
    }
    if (!is_null($timeToLive)) {
        $payload["time_to_live"] = $timeToLive;
    }
    if (!is_null($delayWhileIdle)) {
        $payload["delay_while_idle"] = $delayWhileIdle;
    }
    if (!is_null($extra)) {
        $payload["extra"] = $extra;
    }

    return $payload;
}

/**
 * BlackBerry specific platform override payload.
 *
 * Include either alert or both body and content_type.
 *
 * @param $alert string|null Alert text. Shortcut for content_type text/plain.
 * @param $body string|null Body to send to the device.
 * @param $contentType string|null MIME type describing body.
 * @return array
 * @throws InvalidArgumentException
 */
function blackberry($alert, $body=null, $contentType=null)
{
    $payload = array();
    if (!is_null($alert)) {
        $payload["alert"] = $alert;
        return $payload;
    }
    if (is_null($body) or is_null($contentType)) {
        throw new InvalidArgumentException("Either alert or both body and contentType must be set.");
    }
    $payload["body"] = $body;
    $payload["content_type"] = $contentType;
    return $payload;
}

/**
 * WNS specific platform override payload.
 *
 * Must include exactly one of alert, toast, tile, or badge.
 * @param $alert
 * @param $toast
 * @param $tile
 * @param $badge
 * @return array
 * @throws InvalidArgumentException
 */
function wnsPayload($alert=null, $toast=null, $tile=null, $badge=null)
{
    $payload = array();
    if (!is_null($alert)) {
        $payload["alert"] = $alert;
    }
    if (!is_null($toast)) {
        $payload["toast"] = $toast;
    }
    if (!is_null($tile)) {
        $payload["tile"] = $tile;
    }
    if (!is_null($badge)) {
        $payload["badge"] = $badge;
    }

    if (count($payload) == 0) {
        throw new InvalidArgumentException("wnsPayload cannot be empty");
    }
}

/**
 * MPNS specific platform override payload.
 *
 * Must include exactly one of alert, toast, or tile.
 * @param $alert
 * @param $toast
 * @param $tile
 * @return array
 * @throws InvalidArgumentException
 */
function mpnsPayload($alert=null, $toast=null, $tile=null)
{
    $payload = array();
    if (!is_null($alert)) {
        $payload["alert"] = $alert;
    }
    if (!is_null($toast)) {
        $payload["toast"] = $toast;
    }
    if (!is_null($tile)) {
        $payload["tile"] = $tile;
    }
    if (count($payload) == 0) {
        throw new InvalidArgumentException("mpns cannot be empty");
    }
    return $payload;
}

/**
 * Device Type specifier.
 *
 * @param args a list of strings as arguments, for each platform.
 * @return array
 * @throws InvalidArgumentException
 */
function deviceTypes(/*args*/)
{
    static $VALID_DEVICE_TYPES = array("ios", "android", "blackberry", "wns", "mpns");
    foreach (func_get_args() as $type) {
        if (!in_array($type, $VALID_DEVICE_TYPES)) {
            throw new InvalidArgumentException("Invalid device type: " . $type);
        }
    }
    return func_get_args();
}
