<?php
/*
Copyright 2013 Urban Airship and Contributors
*/

namespace UrbanAirship\Push;

function scheduledTime($target)
{
    return array("scheduled_time" => gmdate("Y-m-d\TH:i:s", $target));
}
