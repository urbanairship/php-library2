<?php

class UrbanAirship
{

    private static $_baseUrl = "http://go.urbanairship.com/api";

    public static function getBaseUrl()
    {
        return  self::$_baseUrl;
    }
}


?>