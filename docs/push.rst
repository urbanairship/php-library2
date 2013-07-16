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

These selector functions are all in the :namespace:`Urbanairship\\Push`
namespace. It's recommended to use a shortcut.

.. code-block:: php

   use UrbanAirship\Push as P;

Audience Selectors
------------------

An audience should specify one or more devices. An audience can be a device,
such as a **device token** or **APID**; a tag, alias, or segment; a location;
or a combination. Audience selectors are combined with ``and_``, ``or_``, and
``not_``. All selectors are available in the :class:`UrbanAirship\\Push` namespace.

Simple Selectors
++++++++++++++++

:constant:`UrbanAirship\\Push\\all`
   Select all, to do a broadcast.

   Used in both ``audience`` and ``deviceTypes``.

   .. code-block:: php

      $push->setAudience(P\all);

:function:`UrbanAirship\\Push\\deviceToken`
   Select a single iOS device token.

   .. code-block:: php

      $push->setAudience(P\deviceToken("FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF"));

:function:`UrbanAirship\\Push\\devicePin`
   Select a single BlackBerry PIN.

:function:`UrbanAirship\\Push\\apid`
   Select a single Android APID.

:function:`UrbanAirship\\Push\\wns`
   Select a single Windows 8 APID.

:function:`UrbanAirship\\Push\\mpns`
   Select a single Windows Phone 8 APID.

:function:`UrbanAirship\\Push\\tag`
   Select a single tag.

:function:`UrbanAirship\\Push\\alias`
   Select a single alias.

:function:`UrbanAirship\\Push\\segment`
   Select a single segment.

Compound Selectors
++++++++++++++++++

:function:`UrbanAirship\\Push\\or_`
   Select an audience that matches at least one of the given arguments.

   .. code-block:: php

      $push->setAudience(P\or_(P\tag("foo"), P\tag("bar")));

:function:`UrbanAirship\\Push\\and_`
   Select an audience that matches all of the given arguments.

:function:`UrbanAirship\\Push\\not_`
   Select an audience that does not match the given selector.

   .. code-block:: php

      $push->setAudience(P\not(P\tag("foo")));

Location Selectors
++++++++++++++++++

:function:`UrbanAirship\\Push\\location`
   Select a location expression.

   Location expressions are made up of either an id or an alias and a time
   period specifier. Use one of the date specifier functions to return a
   properly formatted time specifier.

:function:`UrbanAirship\\Push\\recentDate`

   Produces a time specifier that represents relative amount of time, such
   as "the past three days"

:function:`UrbanAirship\\Push\\absoluteDate`
   Produces a time specifier that represents an absolute amount of time,
   such as from 2012-01-01 12:00 to 2012-01-01 12:00

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

.. php:function:: android([$alert[, collapseKey[, timeToLive[,
      delayWhileIdle[, extra]]]]])

    Android specific platform override payload.

    All arguments are optional.

    :param alert: Alert text.
    :type alert: string
    :param collapseKey: String
    :param timeToLive: Integer
    :param delayWhileIdle: Boolean
    :param extra: A set of key/value pairs to include in the push payload
        sent to the device. All values must be strings.

    See
    `GCM Advanced Topics <http://developer.android.com/google/gcm/adv.html>`_
    for details on ``collapseKey``, ``timeToLive``, and
    ``delayWhileIdle``.

