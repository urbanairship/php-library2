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


class BackberryMessagePayload extends Payload {

    const BLACKBERRY_CONTENT_TYPE_KEY = "content-type";
    const BLACKBERRY_BODY_KEY = "body";

    private $contentType;
    private $body;

    /**
     * Get the current content-type.
     * @return mixed
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * Set a new content type for this message.
     * @param $contentType
     * @return $this\
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        return $this;
    }

    /**
     * Get the current body of this message
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set a new payload body.
     * @param $body
     * @return $this
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * Create a new Blackberry Message Payload
     * @return BackberryMessagePayload
     */
    public static function payload()
    {
        return new BackberryMessagePayload();
    }

    /**
     * Metadata for this object, as an array with key set for JSON
     * serialization.
     * @return array
     */
    public function metadata()
    {
        return array(self::BLACKBERRY_CONTENT_TYPE_KEY => $this->contentType,
            self::BLACKBERRY_BODY_KEY => $this->body);
    }

    /**
     * Takes all the parameters of the object and creates a JSON object
     * with the proper keys for the Urban Airship API
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return $this->removeNilValuesFromPayload($this->metadata());
    }


}