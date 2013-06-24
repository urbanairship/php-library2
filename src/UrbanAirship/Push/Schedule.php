<?php

namespace UrbanAirship\Push;

function scheduledTime($target)
{
    return array("scheduled_time" => gmdate("Y-m-d\TH:i:s", $target));
}
