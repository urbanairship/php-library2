Defining and Sending Push Notifications
=======================================

The Urban Airship PHP Library strives to match the standard Urban Airship
JSON format for specifying push notifications. When creating a push
notification, you:

#. Select the audience
#. Define the notification payload
#. Specify device types.
#. Deliver the notification.

This example performs a broadcast with the same alert to all recipients and
device types:

.. code-block:: php

   require_once 'vendor/autoload.php';

   use Urbanairship\Airship;
   use UrbanAirship\Push as P;

   $response = $airship->push()
       ->setAudience(P\all)
       ->setNotification(P\notification("Hello, World!"))
       ->setDeviceTypes(P\all)
       ->send();

.. php:namespace:: UrbanAirship\Push

Audience Selectors
------------------

An audience should specify one or more devices. An audience can be a device,
such as a **device token** or **APID**; a tag, alias, or segment; a location;
or a combination. Audience selectors are combined with ``and_``, ``or_``, and
``not_``. All selectors are available in the ``UrbanAirship\Push`` namespace.

Simple Selectors
++++++++++++++++

.. php:global:: all

   Select all, to do a broadcast.

   Used in both ``audience`` and ``deviceTypes``.

   .. code-block:: php

      $push->setAudience(P\all);

.. php:function:: deviceToken($token)

   Select a single iOS device token.

   .. code-block:: php

      $push->setAudience(P\deviceToken("FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF"));

.. php:function:: devicePin($pin)

   Select a single BlackBerry PIN.

.. php:function:: apid($apid)

   Select a single Android APID.

.. php:function:: wns($uuid):

   Select a single Windows 8 APID.

.. php:function:: mns($uuid)

   Select a single Windows Phone 8 APID.

.. php:function:: tag($tag)

   Select a single tag.

.. php:function:: alias($alias)

   Select a single alias.

.. php:function:: segment($segment)

   Select a single segment.

Compound Selectors
++++++++++++++++++

.. php:function:: or_($arg1[, $arg2, ...])

   Select an audience that matches at least one of the given arguments.

   .. code-block:: php

      $push->setAudience(P\or_(P\tag("foo"), P\tag("bar")));

.. php:function:: and_($arg1[, $arg2, ...])

   Select an audience that matches all of the given arguments.

.. php:function:: not_($selector)

   Select an audience that does not match the given selector.

   .. code-block:: php

      $push->setAudience(P\not(P\tag("foo")));

Location Selectors
++++++++++++++++++

.. php:function:: location($date, array $locationOpts)

   Select a location expression.

   Location expressions are made up of either an id or an alias and a time
   period specifier. Use one of the date specifier functions to return a
   properly formatted time specifier

   :param date: A date range specifier, created by either
      :php:func`recentDate` or :php:func`absoluteDate`.
   :param locationOpts: An array containing either id and value, or an alias
      and value, e.g. ``array("id"=>"4oFkxX7RcUdirjtaenEQIV")`` or
      ``array("us_zip": "94103")``.

.. php:function:: recentDate($resolution, $lengthOfTime[, $lastSeen=false])

   Produces a time specifier that represents relative amount of time, such
   as "the past three days"

   :param resolution: A string argument specifying a time resolution, e.g.
      ``minutes`` or ``weeks``.
   :param lengthOfTime: Amount of time.
   :param lastSeen: bool. Match a device only if
      its last recorded position matches the location. If it has update
      location anywhere else since, even if it otherwise matches the time
      window, it will be excluded.

.. php:function:: absoluteDate($resolution, $start, $end[, $lastSeen=false])

   Produces a time specifier that represents an absolute amount of time,
   such as from 2012-01-01 12:00 to 2012-01-01 12:00

   :param resolution: Valid time resolution
   :type resolution: string
   :param start: Beginning of absolute window
   :type start: string
   :param end: End of absolute window
   :type end: string
   :param lastSeen: Match a device only if its last recorded position
      matches the location. If it has update location anywhere else since, even
      if it otherwise matches the time window, it will be excluded.
   :type lastSeen: bool

Notifcation Payload
-------------------

The notification payload determines what message and data is sent to a device.
At its simplest, it consists of a single string-valued attribute, "alert",
which sends a push notification consisting of a single piece of text:

.. code-block:: php

   $push->setNotification(P\notification("Hello, world!"))

You can override the payload with platform-specific values as well.

.. php:function:: notification($alert[, $overrides])

   Creates a notification payload.

   :param alert: Global alert for all device types. Use null for no alert.
   :type alert: string or null
   :param overrides: Optional array of platform overrides.
   :type overrides: array

   .. code-block:: php

      $push->setNotification(P\notification(
         "Hello others",
         array("ios"=>P\ios("Hello iOS", "+1"))))

.. php:function:: ios([$alert[, $badge[, $sound[, $content_available[, $extra]]]]])

   iOS/APNS specific platform override payload.

   :param alert: iOS format alert, as either a string or array.
   :type alert: string or array
   :param badge: An integer badge value or an autobadge string.
   :type badge: integer or string
   :param sound: A sound file to play.
   :type sound: string
   :param contentAvailable: If true, pass on the content_available command
      for Newsstand iOS applications.
   :type contentAvailable: bool
   :param extra: A set of key/value pairs to include in the push payload
      sent to the device.
   :type extra: array

   .. code-block:: php

      $push->setNotification(P\notification(
         null,
         array("ios"=>P\ios(
            "Hello iOS",
            "+1",
            "cow.caf",
            false,
            array("articleid" => "AB1234")
         ))
      ))
