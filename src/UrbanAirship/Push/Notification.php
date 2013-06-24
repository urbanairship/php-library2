<?php

namespace Urbanairship\Push;

use InvalidArgumentException;

const AUTOBADGE_FORMAT = "/^(auto)|([+-][0-9]+)$/";

/**
 * Creates a notification payload.
 *
 * @param $alert string Global alert for all device types. Use null for no alert.
 * @return array
 * @throws \InvalidArgumentException If result payload is empty.
 */
function notification($alert=null)
{
    $payload = array();
    if ($alert != null) {
        $payload["alert"] = $alert;
    }
    if (count($payload) == 0) {
        throw new InvalidArgumentException("Notification cannot be empty");
    }

    return $payload;
}

/**
 * iOS/APNS specific platform override payload.
 *
 * @param alert: iOS format alert, as either a string or array.
 * @param badge: An integer badge value or an autobadge string.
 * @param sound: An string sound file to play.
 * @param content_available: If true, pass on the content_available command
 * for Newsstand iOS applications.
 * @param extra: A set of key/value pairs to include in the push payload
 * sent to the device.
 * @throws \InvalidArgumentException for invalid values.
 */
function ios($alert=null, $badge=null, $sound=null, $content_available=false,
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
    if ($content_available) {
        $payload["content_available"] = true;
    }
    if (!is_null($extra)) {
        $payload["extra"] = $extra;
    }

    return $payload;
}

/**
 * Device Type specifier.
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
