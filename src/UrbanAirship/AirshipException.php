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

    public static function fromRequest($request) {
        $exc = new AirshipException();
        $payload = json_decode($request->response('raw_body'), true);
        if ($payload != null) {
            foreach ($exc->expected_keys as $key) {
                if (array_key_exists($key, $payload)) {
                    $exc->$key = $payload[$key];
                }
            }
        } else {
            $exc->error = $request->response('raw_body');
        }
        $exc->code = $request->response('code');
        $exc->message = sprintf("Airship request failed: %s on %s to %s",
            $request->response('code'), '?', $request->lastResUrl());
        return $exc;
    }
}
