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

namespace UrbanAirship\Push\Payload;

abstract class Payload implements \JsonSerializable
{

    /**
     * Returns an reduced array that only has key value pairs with non null
     * values.
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