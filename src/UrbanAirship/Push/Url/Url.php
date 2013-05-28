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


class Url
{

    /**
     * @var string $URL_PATH_SEPARATOR Path separator for URLs as strings
     */
    private static $URL_PATH_SEPARATOR = "/";

    /**
     * @var string $BASE_URL The base url for the Urban Airship API
     */
    protected   static $BASE_URL = "https://go.urbanairship.com/api";

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