Urban Airship PHP Library (Beta)
================================
PHP library for use with the Urban Airship API for sending push notifications. Supports iOS, Android, and Windows.

Urban Airship is no longer actively developing this library but will respond to submitted issues and pull requests. It is provided as sample code, and Urban Airship makes no guarantees as to completeness or regularity of updates. However, we do welcome pull requests with a signed [Contributor License Agreement](https://docs.google.com/forms/d/e/1FAIpQLScErfiz-fXSPpVZ9r8Di2Tr2xDFxt5MgzUel0__9vqUgvko7Q/viewform).

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
        ->setAudience(P\all)
        ->setNotification(P\notification("Hello from php"))
        ->setDeviceTypes(P\all)
        ->send();
} catch (AirshipException $e) {
    print_r($e);
}
```

Resources
---------

- [Home page](http://docs.urbanairship.com/reference/libraries/php/)
- [Source](https://github.com/urbanairship/php-library2)
- [Support](http://support.urbanairship.com/)
