<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/13/13
 * Time: 3:02 PM
 */

namespace UrbanAirship\Push\Url;

class IosUrl extends Url
{
    /**
     * @var string $PUSH_PATH Push path.
     */
    private static $PUSH_PATH = "push";

    /**
     * @var string $$DEVICE_TOKEN_PATH Device Token Path.
     */
    private static $DEVICE_TOKEN_PATH = "device_tokens";

    /**
     * @return string Device token path for URL
     */
    protected  static function deviceTokenPath()
    {
        return self::$DEVICE_TOKEN_PATH;
    }

    /**
     * @return string Push Path for URL
     */
    protected  static function pushPath()
    {
        return self::$PUSH_PATH;
    }

    public static function iosRegistration($deviceToken)
    {
        return self::appendPathComponentsToURL(self::urbanAirshipBaseApiUrl(),
            array(self::$DEVICE_TOKEN_PATH, $deviceToken));
    }

    public static function iosDeviceInformation($deviceToken)
    {
        return IosUrl::iosRegistration($deviceToken);
    }

    public static function iosPushMessage()
    {
        return self::appendPathComponentsToURL(self::urbanAirshipBaseApiUrl(),
            array(self::$PUSH_PATH));
    }
}