<?php


namespace UrbanAirship\Push\Url;


class Url
{
    /**
     * @var string $BASE_URL The base url for the Urban Airship API
     */
    private static $BASE_URL = "https://go.urbanairship.com/api";

    /** @var string $URL_PATH_SEPARATOR Path separator for URLs as strings */
    private static $URL_PATH_SEPARATOR = "/";

    public static function urbanAirshipBaseApiUrl()
    {
        return self::$BASE_URL;
    }

    /** Path separator for URL's  */
    public static function urlPathSeparator()
    {
        return self::$URL_PATH_SEPARATOR;
    }

    /**
     * Create a URL with the given base URL and extra components. The components
     * are appended to the URL using the $PATH
     * @param $url
     * @param $pathComponents
     * @return string
     */
    protected static function appendPathComponentsToURL($url, $pathComponents)
    {
        $path = implode(self::$URL_PATH_SEPARATOR, $pathComponents);
        return "{$url}/{$path}/";
    }

}