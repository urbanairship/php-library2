Urban Airship PHP Library (Beta)
================================
PHP library for use with the Urban Airship API for sending push notifications. Supports iOS, Android, and Blackberry.

**Requirements**

PHP >= 5.4.14

**Dependencies**

- Composer
- Httpful
- Monolog

**Development Dependencies**

PHPUnit

**Use**

```PHP
// Setup some logging. Default is a stream handler. We use the Monolog library,
// which is PRS-3 compliant, so any logging framework that complies with the standard
// could be used. Read more about the FIG standards here:
// https://github.com/php-fig/fig-standards

UALog::setLogHandlers(array(new StreamHandler("php://stdout", Logger::DEBUG)));
$log = UALog::getLogger();

// Set up your key and secret for the Urban Airship API
$appKey = "key";
$appSecret = "secret";

// The library supports all of the push types for Urban Airship, push notifications,
// broadcast notifications, and batch. This example utilizes the push notification, which
// sends a notification to a list of tokens.
$deviceToken = "token";

// Build a message payload with the necessary data for your notification. The library supports
// iOS, Android, and Blackberry.
$apsMessage = IosMessagePayload::payload()
    ->setAlert("Push Message")
    ->setBadge(1)
    ->setSound("customSound.caf");

// Setup a payload that matches the type of message you want to send, either
// a push, broadcast, or batch. See the Urban Airship documentation for payload formatting.
$pushPayload = NotificationPayload::payload()
    ->setAps($apsMessage)
    ->setDeviceTokens(array($deviceToken));

// Create a request, set up authentication and payload, and send it. The response is wrapped and
// returned. Logging is built in, and uses the logger you provide.
$pushNotificationResponse = PushNotificationRequest::request()
    ->setAppKey($appKey)
    ->setAppSecret($appSecret)
    ->setPushNotificationPayload($pushPayload)
    ->send();

// Check the response for errors
if ($pushNotificationResponse->hasErrors()) {
    $log->error("Push notification didn't work");
}
else {
    $log->debug("Push message succeeded");
}
```


