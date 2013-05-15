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
     * @var string $$DEVICE_TOKEN_PATH Device Token Path.
     */
    private static $DEVICE_TOKEN_PATH = "device_tokens";

    private static $FEEDBACK_PATH = "feedback";

    private static $FEEDBACK_QUERY_PARAM = "?since=";


    /**
     * @return string Device token path for URL
     */
    protected  static function deviceTokenPath()
    {
        return self::$DEVICE_TOKEN_PATH;
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

    /**
     * Queries the feedback service for inactive tokens, which include tokens
     * that have been marked inactive by Urban Airship and tokens which have
     * been marked inactive by Apple.
     *
     * @param $isoDateString string Date in ISO 8601 date parameter
     * @return
     */
    public static function iosFeedbackSince($isoDateString)
    {
        $query = self::$FEEDBACK_QUERY_PARAM;
        $timeQuery = "{$query}{$isoDateString}";
        return self::appendPathComponentsToURL(self::$BASE_URL,
            array(self::$DEVICE_TOKEN_PATH,
                self::$FEEDBACK_PATH,
                $timeQuery));

    }

}