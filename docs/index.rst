Airship PHP Library
===================

This library is a PHP wrapper for the `Airship API`_.

This library is deprecated. We no longer develop or update it. It
provides sample code only, with no guarantees of completeness.
We may respond to issues submitted to https://support.airship.com.

Goals
-----

* Provide a simple interface for the most commonly used APIs
* Use modern PHP conventions, including using namespaces, abiding by the
  `PHP-FIG Standards`_, and being autoloadable.

Requirements
------------

* PHP >= 5.3 (You are responsible for utilizing a safe, patched PHP version)
* composer
* httpful
* monolog

Quick example
-------------

.. code-block:: php

   require_once 'vendor/autoload.php';

   use Urbanairship\Airship;
   use UrbanAirship\Push as P;

   $response = $airship->push()
       ->setAudience(P\iosChannel("Insert your iOS channel here!"))
       ->setNotification(P\notification("Hello from PHP"))
       ->setDeviceTypes(P\deviceTypes("ios"))
       ->send();

   print "Push sent!. Push IDs:" . $response.push_ids;

Logging
-------

The library uses Monolog_ for request and response logging. At the `DEBUG`
level all requests and responses are logged. At `INFO` succsesful push
requests are logged.

To control the logging, set a handler and a log level.

.. code-block:: php

   use UrbanAirship\UALog;
   use Monolog\Logger;
   use Monolog\Handler\StreamHandler;

   UALog::setLogHandlers(array(new StreamHandler("php://stdout", Logger::DEBUG)));

To turn off all logging, use a ``NullHandler``

.. code-block:: php

   use UrbanAirship\UALog;
   use Monolog\Logger;
   use Monolog\Handler\NullHandler;

   UALog::setLogHandlers(array(new NullHandler()));

Contents:

.. toctree::
   :maxdepth: 2

   push.rst
   devices.rst

Indices and tables
==================

* :ref:`genindex`
* :ref:`modindex`
* :ref:`search`


.. _Airship API: https://docs.airship.com/api/ua/
.. _PHP-FIG Standards: http://www.php-fig.org/
.. _Monolog: https://github.com/Seldaek/monolog
