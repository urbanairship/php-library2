<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/7/13
 * Time: 1:33 PM
 */

namespace UrbanAirship\Push\Payload;

abstract class Payload implements \JsonSerializable
{

    /**
     * Returns an reduced array that only has non null key/value pairs
     * @param $payloadWithNilValues Array that contains null values
     * @return array Array with null values removed
     */
    public function removeNilValuesFromPayload($payloadWithNilValues)
    {

        $payloadWithoutNilValues = array_filter($payloadWithNilValues, function ($value){
            if(is_null($value)) {
                return false;
            }
            else {
                return true;
            }
        });
        return $payloadWithoutNilValues;

    }

}