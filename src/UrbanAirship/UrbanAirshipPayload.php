<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/7/13
 * Time: 1:33 PM
 */

namespace UrbanAirship;

abstract class UrbanAirshipPayload implements \JsonSerializable
{


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