Airship PHP Library
===================

PHP library for use with the Airship REST API for sending notifications.
Supports iOS, Android, Amazon, and Windows.

This library is deprecated. We no longer develop or update it. It
provides sample code only, with no guarantees of completeness.
We may respond to issues submitted to https://support.airship.com.

Requirements
------------

PHP >= 5.3 (You are responsible for utilizing a safe, patched PHP version)

**Dependencies**

- Composer
- Httpful
- Monolog

**Development Dependencies**

PHPUnit

Example Usage
-------------

```php
<?php

require_once 'vendor/autoload.php';

use UrbanAirship\Airship;
use UrbanAirship\AirshipException;
use UrbanAirship\UALog;
use UrbanAirship\Push as P;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

UALog::setLogHandlers(array(new StreamHandler("php://stdout", Logger::DEBUG)));

$airship = new Airship("<app key>", "<master secret>");

try {
    $response = $airship->push()
        ->setAudience(P\iosChannel("Insert your iOS channel here!"))
        ->setNotification(P\notification("Hello from PHP"))
        ->setDeviceTypes(P\deviceTypes("ios"))
        ->send();
} catch (AirshipException $e) {
    print_r($e);
}
```

Resources
---------

- [Home page](https://docs.airship.com/api/libraries/php/)
- [Source](https://github.com/urbanairship/php-library2)
- [Support](https://support.airship.com/)
