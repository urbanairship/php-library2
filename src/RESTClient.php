<?php
/**
 * Created by IntelliJ IDEA.
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 4/29/13
 * Time: 3:09 PM
 * To change this template use File | Settings | File Templates.
 */

require_once "HTTP/Request2.php";

class RESTClient {

    public static function createBasicAuthRequest($method, $url, $user, $password){
        $request = new HTTP_Request2($url);
        return $request;
    }
}