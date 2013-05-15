<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/15/13
 * Time: 9:25 AM
 */

namespace UrbanAirship\Push\Url;

/**
 * Class NotificationUrl
 * Three types of push notification URLs, push, batch, broadcast
 * @package UrbanAirship\Push\Url
 */
class NotificationUrl extends Url {

    /**
     * @var string $PUSH_PATH Push path.
     */
    protected static $PUSH_PATH = "push";

    protected static $BATCH_PATH = "batch";

    protected static $BROADCAST_PATH = "broadcast";


    public static function pushNotificationUrl()
    {
        return self::appendPathComponentsToURL(self::$BASE_URL,
            array(self::$PUSH_PATH));
    }

    public static function broadcastNotificationUrl()
    {
        return self::appendPathComponentsToURL(self::$BASE_URL,
            array(self::$PUSH_PATH, self::$BROADCAST_PATH));
    }

    public static function batchNotificationUrl()
    {
        return self::appendPathComponentsToURL(self::$BASE_URL,
            array(self::$PUSH_PATH, self::$BATCH_PATH));
    }
}