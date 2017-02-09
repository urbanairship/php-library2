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
 * @param $expiry int|string: The expiry time for APNS to cease trying to deliver a push.
 * @param $priority int: Sets the APNS priority of the delivery.
 * @param $category string: Sets the APNs category for the push.
 * @param $interactive Object: Conforms to the standard interactive object specifications.
 * @param $mutableContent boolean: When set to true, content may be modified by an extension.
 * @param $mediaAttachment JSON: Specifies a media attachment to be handled by the UA Media 
 * Attachment Extension.
 * @param $title string: Sets the title of the notification.
 * @param $subtitle string: Displays below the title of the notification.
 * @param $collapseID string: When there is a newer message that renders an older, related 
 * message irrelevant to the client app, the new message replaces the older message with the 
 * same collapse_id.
 * @return array
 * @throws \InvalidArgumentException for invalid values.
 */
function ios($alert=null, $badge=null, $sound=null, $contentAvailable=false,
        $extra=null, $expiry=null, $priority=null, $category=null, $interactive=null, 
        $mutableContent=false, $mediaAttachment=null, $title=null, $subtitle=null, $collapseId=null)
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
    if ($expiry) {
        if (!is_int($expiry) && !is_string($expiry)) {
            trigger_error("Expiry must either be an integer, or string of a timestamp in ISO UTC format.",
             E_USER_WARNING);
            die();
        }
        $payload["expiry"] = $expiry;
    }
    if ($priority) {
        if(!is_int($priority)) {
            trigger_error("iOS priority must be an integer.",
             E_USER_WARNING);
            die();
        } 
        $payload["priority"] = $priority;
    }
    if ($category) {
        if (!is_string($category)) {
            trigger_error("iOS category must be a string.",
             E_USER_WARNING);
            die();
        }
        $payload["category"] = $category;
    }
    if ($interactive) {
        $payload["interactive"] = $interactive;
    }
    if ($mutableContent) {
        $payload["mutable_content"] = true;
    }
    if ($mediaAttachment) {
        $payload["media_attachment"] = $mediaAttachment;
    }
    if ($title) {
        if (!is_string($title)) {
            trigger_error("iOS title must be a string.",
             E_USER_WARNING);
            die();
        }
        $payload["title"] = $title;
    }
    if ($subtitle) {
        $payload["subtitle"] = $subtitle;
    }
    if ($collapseId) {
        $payload["collapse_id"] = $collapseId;
    }

    return $payload;
}

/**
 * Android specific platform override payload.
 *
 * @link http://developer.android.com/google/gcm/adv.html GCM Advanced Topics
 * for details on `collapseKey`, `timeToLive`, and `delayWhileIdle`.
 *
 * @param $alert string: Android format alert.
 * @param $collapseKey string
 * @param $timeToLive int|string: Specifies the expiration time for the message. 
 * @param $deliveryPriority string: Defaults to normal if not provided. Sets the GCM priority.
 * @param $delayWhileIdle boolen
 * @param $extra array: A set of key/value pairs to include in the push payload
 * sent to the device.
 * @param $style array: Android/Amazon advanced styles.
 * @param $title string: Title of the notification.
 * @param $summary string: Summary of the notification.
 * @param $sound string: A sound file name included in the application’s resources.
 * @param $priority int: In the range from -2 to 2, inclusive. Used to help determine 
 * notification sort order.
 * @param $category string: Optional string from the following list: "alarm", "call", "email", 
 * "err", "event", "msg", "promo", "recommendation", "service", "social", "status", "sys", and 
 * "transport". It is used to help determine notification sort order.
 * @param $visibility int: Optional integer in the range from -1 to 1 inclusive.
 * @param $publicNotification Object: A notification to show on the lock screen instead of the 
 * redacted one.
 * @param $publicOnly boolean: Set this to true if you do not want this notification to bridge * to other devices (wearables).
 * @param $wearable Object
 * @return array
 */
function android($alert=null, $collapseKey=null, $timeToLive=null,
    $deliveryPriority=null, $delayWhileIdle=null, $extra=null, $style=null, $title=null, 
    $summary=null, $sound=null, $priority=null, $category=null, 
    $visibility=null, $publicNotification=null, $localOnly=false, $wearable=null)
{
    $payload = array();
    if ($alert) {
        $payload["alert"] = $alert;
    }
    if ($collapseKey) {
        $payload["collapse_key"] = $collapseKey;
    }
    if ($timeToLive) {
        if (!is_int($timeToLive) && !is_string($timeToLive)) {
            trigger_error("Android timeToLive must either be an integer, or string of a timestamp in ISO UTC format.",
             E_USER_WARNING);
            die();
        }
        $payload["time_to_live"] = $timeToLive;
    }
    if ($deliveryPriority) {
        $payload["delivery_priority"] = $deliveryPriority;
    }
    if ($delayWhileIdle) {
        $payload["delay_while_idle"] = $delayWhileIdle;
    }
    if ($extra) {
        $payload["extra"] = $extra;
    }
    if ($style) {
        $payload["style"] = $style;
    }
    if ($title) {
        if (!is_string($title)) {
            trigger_error("Android title must be a string.",
             E_USER_WARNING);
            die();
        }
        $payload["title"] = $title;
    }
    if ($summary) {
        $payload["summary"] = $summary;
    }
    if ($sound) {
        $payload["sound"] = $sound;
    }
    if ($priority) {
        $payload["priority"] = $priority;
    }
    if ($category) {
        $validAndroidCategories = array("alarm", "call", "email", "err", "event", "msg", "promo", "recommendation", "service", "social", "status", "sys", "transport");
        if (!in_array($category, $validAndroidCategories)) {
            trigger_error("Category must be set to one of ".join(", ", $validAndroidCategories).".",
             E_USER_WARNING);
            die();
        }
        $payload["category"] = $category;
    }
    if ($visibility) {
        $payload["visibility"] = $visibility;
    }
    if ($publicNotification) {
        $payload["public_notification"] = $publicNotification;
    }
    if ($localOnly) {
        if (!is_bool($localOnly)) {
            trigger_error("Android local_only must be a boolean value.",
             E_USER_WARNING);
            die();
        }
        $payload["local_only"] = $localOnly;
    }
    if ($wearable) {
        if (!is_array($wearable)) {
             trigger_error("Android wearable must be an array.",
              E_USER_WARNING);
             die();
        }
        $payload["wearable"] = $wearable;
    }

    return $payload;
}


/**
 * Amazon specific platform override payload.
 *
 * @link https://docs.urbanairship.com/api/ua.html#amazon Amazon Platform Overrides
 * for details on `consolidation_key` and `expires_after`.
 *
 * @param $alert string: Amazon format alert.
 * @param $consolidation_key string: Similar to GCM’s collapse_key.
 * @param $expires_after int: An integer value indicating the number of seconds that ADM will 
 * retain the message if the device is offline. The valid range is 60 - 2678400 (1 minute to 
 * 31 days), inclusive. Can also be an absolute ISO UTC timestamp, in which case the same 
 * validation rules apply, with the time period calculated relative to the time of the API 
 * call.
 * @param $title string: A string representing the title of the notification. The default 
 * value is the name of the app at the SDK.
 * @param $summary string: A string representing a summary of the notification.
 * @param $extra array: A set of key/value pairs to include in the push payload
 * sent to the device.
 * @param $title string: Title of the notification. 
 * @param $summary string: Summary of the notification.
 * @param $style array: Android/Amazon advanced styles.
 * @param $sound string: A sound file name included in the application’s resources.  
 * @return array
 */
function amazon($alert=null, $consolidation_key=null, $expires_after=null, 
    $title=null, $summary=null, $extra=null, $style=null, $sound=null)
{
    $payload = array();
    if ($alert) {
        $payload["alert"] = $alert;
    }
    if ($consolidation_key) {
        $payload["consolidation_key"] = $consolidation_key;
    }
    if ($expires_after) {
        $payload["expires_after"] = $expires_after;
    }
    if ($extra) {
        $payload["extra"] = $extra;
    }
    if ($title) {
        $payload["title"] = $title;
    }
    if ($summary) {
        $payload["summary"] = $summary;
    }
    if ($style) {
        $payload["style"] = $style;
    }
    if ($sound) {
        $payload["sound"] = $sound;
    }

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
    static $VALID_DEVICE_TYPES = array("ios", "android", "wns", "mpns", "amazon");
    foreach (func_get_args() as $type) {
        if (!in_array($type, $VALID_DEVICE_TYPES)) {
            throw new InvalidArgumentException("Invalid device type: " . $type);
        }
    }
    return func_get_args();
}

/**
 * Message Center Object
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
            trigger_error("Expiry must either be an integer, or string of a timestamp in ISO UTC format.",
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
             trigger_error("Icons must be an array.",
              E_USER_WARNING);
             die();
        }
        $payload["icons"] = $icons;
    }

    return $payload;
}

/**
 * In-App Message object
 *
 * @param alert String
 * @param displayType String: Specifies the display type. Currently, the only valid 
 * option is "banner".
 * @param expiry int|timestamp: Specifies the time when the in-app message will expire. 
 * Defaults to 90 days from time of API request. Integer values will be interpreted as seconds
 * from now (time of API request).
 * @param display Object: Specifies the appearance of the in-app message.
 * @param actions Object: Specifies actions which occur when the user taps on the in-app 
 * message
 * @param interactive Object: Specifies interactive category and associated actions.
 * @param extra Object
 * @return array
 */

function inAppMessage($alert, $displayType, $expiry=null, $display=null, $actions=null,
 $interactive=null, $extra=null)
{
    // Display Type can only be set to 'banner' at this time
    $displayType = "banner";

    if ($alert) {
        $payload["alert"] = $alert;
    }
    if ($displayType) {
        $payload["display_type"] = $displayType;
    }
    if ($expiry) {
        if (!is_int($expiry) && !is_string($expiry)) {
            trigger_error("Expiry must either be an integer, or string of a timestamp in ISO UTC format.",
             E_USER_WARNING);
            die();
        }
        $payload["expiry"] = $expiry;
    }
    if ($display) {
        $payload["display"] = $display;
    }
    if ($actions) {
        $payload["actions"] = $actions;
    }
    if ($interactive) {
        $payload["interactive"] = $interactive;
    }
    if ($extra) {
        $payload["extra"] = $extra;
    }

    return $payload;
}
