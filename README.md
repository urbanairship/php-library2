Airship PHP Library
===================

PHP library for use with the Airship REST API for sending notifications.
Supports iOS, Android, Amazon, and Windows.

Airship is no longer actively developing this library, but will respond to
feature requests, issues, and pull requests when they are submitted via
https://support.airship.com. This library is provided as sample code, and
Airship makes no guarantees as to completeness or regularity of updates.
However, we do welcome pull requests with a signed `contribution agreement <https://docs.google.com/forms/d/e/1FAIpQLScErfiz-fXSPpVZ9r8Di2Tr2xDFxt5MgzUel0__9vqUgvko7Q/viewform>`__.

Requirements
------------

PHP >= 5.3

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
