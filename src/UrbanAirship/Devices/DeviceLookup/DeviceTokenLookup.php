<?php
/*
Copyright 2013-2016 Urban Airship and Contributors
*/

namespace UrbanAirship\Devices\DeviceLookup;


class DeviceTokenLookup
{

    const LOOKUP_URL = "/api/device_tokens/";

    /**
     * @var object Device info for device id
     */
	private $deviceInfo;

    function __construct($airship, $deviceId)
	{
		$this->airship = $airship;
		$this->identifier = $deviceId;
		$this->lookup_url = $airship->buildUrl(static::LOOKUP_URL.$deviceId);
	}

	/**
	 * Fetch metadata from a channel ID
	 */
	function deviceTokenInfo() {
		if ($this->identifier == null) {
			return null;
    	} else {
    		$url = $this->lookup_url;
			$response = $this->airship->request("GET", null, $url, null, 3);
	        $this->deviceInfo = json_decode($response->raw_body);
	        return $this->deviceInfo;
    	}
	}

}
