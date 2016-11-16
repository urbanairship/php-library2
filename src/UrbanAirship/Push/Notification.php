<?php
/*
Copyright 2013-2016 Urban Airship and Contributors
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
    if ($alert) {
        $payload["alert"] = $alert;
    }
    if ($badge) {
        if (is_string($badge)) {
            if (preg_match(AUTOBADGE_FORMAT, $badge) === 0) {
                throw new InvalidArgumentException("Invalid autobadge string");
            }
        } elseif (!is_int($badge)) {
            throw new InvalidArgumentException("Invalid badge type");
        }
        $payload["badge"] = $badge;
    }
    if ($sound) {
        $payload["sound"] = $sound;
    }
    if ($contentAvailable) {
        $payload["content_available"] = true;
    }
    if ($extra) {
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
    if ($alert) {
        $payload["alert"] = $alert;
    }
    if ($collapseKey) {
        $payload["collapse_key"] = $collapseKey;
    }
    if ($timeToLive) {
        $payload["time_to_live"] = $timeToLive;
    }
    if ($delayWhileIdle) {
        $payload["delay_while_idle"] = $delayWhileIdle;
    }
    if ($extra) {
        $payload["extra"] = $extra;
    }

    return $payload;
}


/**
 * Amazon specific platform override payload.
 *
 * @link https://docs.urbanairship.com/api/ua.html#amazon Amazon Platform Overrides
 * for details on `consolidation_key` and `expires_after`.
 *
 * @param $alert string|null
 * @param $consolidation_key string|null Similar to GCM’s collapse_key.
 * @param $expires_after int|null an integer value indicating the number of seconds that ADM will retain the message if the device is offline. The valid range is 60 - 2678400 (1 minute to 31 days), inclusive. Can also be an absolute ISO UTC timestamp, in which case the same validation rules apply, with the time period calculated relative to the time of the API call.
 * @param $title string|null a string representing the title of the notification. The default value is the name of the app at the SDK.
 * @param $summary string|null a string representing a summary of the notification.
 * @param $extra array | A set of key/value pairs to include in the push payload
 * sent to the device.
 * @return array
 */
function amazon($alert=null, $consolidation_key=mull, $expires_after=null, 
    $title=null, $summary=null, $extra=null)
{
    $payload = array();
    if($alert){
        $payload["alert"] = $alert;
    }
    if($consolidation_key){
        $payload["consolidation_key"] = $consolidation_key;
    }
    if($expires_after){
        $payload["expires_after"] = $expires_after;
    }
    if($extra){
        $payload["extra"] = $extra;
    }
    if($title){
        $payload["title"] = $title;
    }
    if($summary){
        $payload["summary"] = $summary;
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
    return $payload;
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
    if ($alert) {
        $payload["alert"] = $alert;
    }
    if ($toast) {
        $payload["toast"] = $toast;
    }
    if ($tile) {
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
    static $VALID_DEVICE_TYPES = array("ios", "android", "blackberry", "wns", "mpns", "amazon");
    foreach (func_get_args() as $type) {
        if (!in_array($type, $VALID_DEVICE_TYPES)) {
            throw new InvalidArgumentException("Invalid device type: " . $type);
        }
    }
    return func_get_args();
}

/**
 * Rich Push Object
 *
 * @param $title string
 * @param $body string
 * @param $content_type string: A string denoting the MIME type of the data in body.
 * @param $content_encoding string: A string denoting encoding type of the data in body.
 * For example, utf-8 or base64.
 * @param $expiry int|timestamp: The expiry time for a rich app page to delete a message from
 * the user’s inbox. Can be an integer encoding number of seconds from now, or an absolute
 * timestamp in ISO UTC format. An integer value of 0 is equivalent to no expiry set.
 * @param $extra string: A JSON dictionary of string values. Values for each entry may only be strings.
 * If an API user wishes to pass structured data in an extra key, it must be properly JSON-encoded
 * as a string.
 * @param $icons string: JSON dictionary of string key and value pairs.
 * At this time, only one key, `"list_icon"`, is supported. Values must be URI/URLs to the icon
 * resources. For resources hosted by UA, use the following URI format `ua:<resource-id>`.
 * For example: `"icons" : { "list_icon" : "ua:9bf2f510-050e-11e3-9446-14dae95134d2" }`
 *
 * @return array
 */
function message($title, $body, $content_type=null, $content_encoding=null,
    $expiry=null, $extra=null, $icons=null)
{
    if (!is_null($title)) {
        $payload["title"] = $title;
    }
    if (!is_null($body)) {
        $payload["body"] = $body;
    }
    if (!is_null($content_type)) {
        $payload["content_type"] = $content_type;
    }
    if (!is_null($content_encoding)) {
        $payload["content_encoding"] = $content_encoding;
    }
    if (!is_null($expiry)) {
        if (!is_int($expiry) && !is_string($expiry)) {
            trigger_error("Expiry value must be an integer or time set in UTC as a string",
             E_USER_WARNING);
            die();
        }
        $payload["expiry"] = $expiry;
    }
    if (!is_null($extra)) {
        $payload["extra"] = $extra;
    }
    if (!is_null($icons)) {
        if (!is_array($icons)) {
             trigger_error("icons must be an array!",
              E_USER_WARNING);
             die();
        }
        $payload["icons"] = $icons;
    }

    return $payload;
}
