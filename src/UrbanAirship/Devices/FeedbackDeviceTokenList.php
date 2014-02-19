<?php
/**
 * Created by PhpStorm.
 * User: invoked
 * Date: 2/19/2014
 * Time: 9:56 AM
 */

namespace UrbanAirship\Devices;

use UrbanAirship\UALog;

/**
 * Class FeedbackDeviceTokenList
 * @package UrbanAirship\Devices
 *
 *          Default since time is yesterday.
 *
 */
class FeedbackDeviceTokenList extends DeviceList
{
	const LIST_URL = "/api/device_tokens/feedback/";

	function __construct($airship, $since=null)
	{
		if(!$since) {

			$since = date('Y-m-d\TH:i:sO', strtotime('yesterday'));

			$logger = UALog::getLogger();
			$logger->debug("Using default feedback since time of 'yesterday' which resolves to: ", array('since'=>$since));
		}
		parent::__construct($airship, null);
		$this->start_url = $airship->buildUrl(static::LIST_URL, array('since'=>$since));
	}
}