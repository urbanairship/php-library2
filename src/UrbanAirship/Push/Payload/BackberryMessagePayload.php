<?php
/**
 * Name: Matt Hooge
 * Company: Urban Airship
 * Date: 5/22/13
 * Time: 12:45 PM
 */

namespace UrbanAirship\Push\Payload;


class BackberryMessagePayload extends Payload {

    const BLACKBERRY_CONTENT_TYPE_KEY = "content-type";
    const BLACKBERRY_BODY_KEY = "body";

    private $contentType;
    private $body;

    public function getContentType()
    {
        return $this->contentType;
    }

    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        return $this;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    public static function payload()
    {
        return new BackberryMessagePayload();
    }

    public function metadata()
    {
        return array(self::BLACKBERRY_CONTENT_TYPE_KEY => $this->contentType,
            self::BLACKBERRY_BODY_KEY => $this->body);
    }

    public function jsonSerialize()
    {
        return $this->removeNilValuesFromPayload($this->metadata());
    }


}