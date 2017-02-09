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
such as a **Channel**; a tag, named user, or segment; a location;
or a combination. Audience selectors are combined with ``and_``, ``or_``, and
``not_``. All selectors are available in the :namespace:`UrbanAirship\\Push` namespace.

Simple Selectors
++++++++++++++++

:constant:`UrbanAirship\\Push\\all`
   Select all, to do a broadcast.

   Used in both ``audience`` and ``deviceTypes``.

   .. code-block:: php

      $push->setAudience(P\all);

:function:`UrbanAirship\\Push\\iosChannel`
   Select a single iOS channel.

   .. code-block:: php

      $push->setAudience(P\iosChannel("8ac440cb-f148-4856-9631-3c8eb8d88d60"));

:function:`UrbanAirship\\Push\\androidChannel`
   Select a single Android channel.

   .. code-block:: php

      $push->setAudience(P\androidChannel("b8f9b663-0a3b-cf45-587a-be880946e880"));

:function:`UrbanAirship\\Push\\deviceToken`
   Select a single iOS device token.

   .. code-block:: php

      $push->setAudience(P\deviceToken("FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF"));

:function:`UrbanAirship\\Push\\amazonChannel`
   Select a single Amazon channel.

:function:`UrbanAirship\\Push\\apid`
   Select a single Android APID.

:function:`UrbanAirship\\Push\\wns`
   Select a single Windows 8 APID.

:function:`UrbanAirship\\Push\\mpns`
   Select a single Windows Phone 8 APID.

:function:`UrbanAirship\\Push\\tag`
   Select a single tag.

:function:`UrbanAirship\\Push\\named_user`
   Select a single named user.

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

Notification Payload
--------------------

The notification payload determines what message and data is sent to a device.
At its simplest, it consists of a single string-valued attribute, "alert",
which sends a push notification consisting of a single piece of text:

.. code-block:: php

   $push->setNotification(P\notification("Hello, world!"))

You can override the payload with platform-specific values as well.

:function:`UrbanAirship\\Push\\notification`
   Creates a notification payload.

   .. code-block:: php

      $push->setNotification(P\notification(
         "Hello others",
         array("ios"=>P\ios("Hello iOS", "+1"))))

:function:`UrbanAirship\\Push\\ios`
   iOS/APNS specific platform override payload.

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

:function:`UrbanAirship\\Push\\android`
    Android specific platform override payload.

   .. code-block:: php

      $push->setNotification(P\notification(
         null,
         array("android"=>P\android(
            "Hello Android",
            null,
            null,
            null,
            false,
            array("articleid" => "AB1234")
         ))
      ))

   See `GCM Advanced Topics
   <http://developer.android.com/google/gcm/adv.html>`_ for details on
   ``collapseKey``, ``timeToLive``, and ``delayWhileIdle``.

:function:`UrbanAirship\\Push\\amazon`
    Amazon specific platform override payload.

   .. code-block:: php

      $push->setNotification(P\notification(
         null,
         array("amazon"=>P\amazon(
            "Hello Amazon",
            null,
            null,
            null,
            null,
            array("articleid" => "AB1234")
         ))
      ))

   See `Amazon Device Messaging
   <https://developer.amazon.com/appsandservices/apis/engage/device-messaging/tech-docs/06-sending-a-message>`_ for details on
   ``consolidation_key`` and ``expires_after``.

:function:`UrbanAirship\\Push\\wnsPayload`
    WNS specific platform override payload.

:function:`UrbanAirship\\Push\\mpnsPayload`
    MPNS specific platform override payload.

Device Types
------------

In addition to specifying the audience, you must specify the device types you
wish to target, either with a list of strings:

.. code-block:: php

   $push->setDeviceTypes(P\deviceTypes('ios', 'android'));

or with the :constant:`UrbanAirship\\Push\\all` shortcut.

.. code-block:: php

   $push->setDeviceTypes(P\all);

In-App Message
--------------

You can send an in-app message alone or with a push notification by using setInAppMessage. See :function:`UrbanAirship\\Push\\inAppMessage` for more information about parameters.

.. code-block:: php

   $push->setInAppMessage(P\inAppMessage("This is the alert text!",
                "banner",
                0,
                array("position"=>"top"),
                null,
                array("type" => "ua_yes_no_foreground", "button_actions" => array(
                "yes" => array("add_tag" => "tapped_yes"), "no" => array("add_tag" => "tapped_no")))
            ))
        );

Message Center
--------------

If you'd like to send a Message Center message along with your notification (or alone), use
setMessage. See :function:`UrbanAirship\\Push\\message` for more information
about parameters.

.. code-block:: php

   $push->setMessage(P\message("This is the title",
                "<html><body><h1>This is the message</h1></body></html>",
                "text/html",
                "utf-8",
                0)
        );

Note: Message Center is not supported on Windows or Windows Phone and
requires additional setup for other platforms. See our API and implementation
docs for more information.
