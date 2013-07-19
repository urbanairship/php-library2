<?php
/*
Copyright 2013 Urban Airship and Contributors
*/

namespace UrbanAirship;

class AirshipException extends \Exception
{
    public $error = null;
    public $error_code = null;
    public $details = null;

    private $expected_keys = array('error', 'error_code', 'details');

    public static function fromResponse($response) {
        $exc = new AirshipException();
        $payload = json_decode($response->raw_body, true);
        if ($payload != null) {
            foreach ($exc->expected_keys as $key) {
                if (array_key_exists($key, $payload)) {
                    $exc->$key = $payload[$key];
                }
            }
        } else {
            $exc->error = $response->raw_body;
        }
        $exc->code = $response->code;
        $exc->message = sprintf("Airship request failed: %s on %s to %s",
            $response->code, $response->request->method, $response->request->uri);
        return $exc;
    }
}
