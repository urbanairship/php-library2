<?php


namespace UrbanAirship\Push\Url;


class Url
{
    /**
     * @var string $BASE_URL The base url for the Urban Airship API
     */
    private  static $BASE_URL = "https://go.urbanairship.com/api";

    /**
     * @var string $URL_PATH_SEPARATOR Path separator for URLs as strings
     */
    private static $URL_PATH_SEPARATOR = "/";

    /**
     * @var string $PUSH_PATH Push path.
     */
    protected static $PUSH_PATH = "push";

    protected static $BATCH_PATH = "batch";

    protected static $BROADCAST_PATH = "broadcast";

    /**
     * @return string Base URL for the Urban Airship API
     */
    public static function urbanAirshipBaseApiUrl()
    {
        return self::$BASE_URL;
    }

    /**
     *@return string  Path separator for URLs
     */
    public static function urlPathSeparator()
    {
        return self::$URL_PATH_SEPARATOR;
    }
    /**
     * @return string Push Path for URL
     */
    protected static function pushPath()
    {
        return self::$PUSH_PATH;
    }

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

    /**
     * Create a URL with the given base URL and extra components. The components
     * are appended to the URL using the $PATH
     * @param $url string Base URL
     * @param $pathComponents string Additional components, concatenated on with
     * $URL_PATH_SEPARATOR
     * @return string Full URL with trailing slash
     */
    protected static function appendPathComponentsToURL($url, $pathComponents)
    {
        $path = implode(self::$URL_PATH_SEPARATOR, $pathComponents);
        return "{$url}/{$path}/";
    }

}