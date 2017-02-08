Urban Airship PHP Library
=========================

This library is a wrapper for the `Urban Airship API`_ for
PHP.

Urban Airship is no longer actively developing this library but will respond to submitted issues and pull requests. It is provided as sample code, and Urban Airship makes no guarantees as to completeness or regularity of updates. However, we do welcome pull requests with a signed `contribution agreement <http://urbanairship.com/legal/contribution-agreement>`__.

Goals
-----

* Provide a simple interface for the most commonly used APIs
* Use modern PHP conventions, including using namespaces, abiding by the
  `PHP-FIG Standards`_, and being autoloadable.

Requirements
------------

* PHP 5.3 or 5.4.
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
       ->setAudience(P\deviceToken("ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff"))
       ->setNotification(P\notification("Hello from php!"))
       ->setDeviceTypes(P\all)
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


.. _Urban Airship API: http://docs.urbanairship.com/api/overview.html
.. _PHP-FIG Standards: http://www.php-fig.org/
.. _Monolog: https://github.com/Seldaek/monolog
