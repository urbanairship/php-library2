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