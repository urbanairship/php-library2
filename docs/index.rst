Urban Airship PHP Library
=========================

This library is a wrapper for the `Urban Airship web service API <uaapi>`_ for
PHP.

Goals
-----

* Provide a simple interface for the most commonly used APIs
* Use modern PHP conventions, including using namespaces, abiding by the
  `PHP-FIG Standards <fig>`_, and being autoloadable.

Requirements
------------

* PHP 5.3 or 5.4.
* composer
* httpful
* monolog

Quick example
-------------

.. code-block:: php

   <?php
   require_once 'vendor/autoload.php';

   use Urbanairship\Airship;
   use UrbanAirship\Push as P;

   $response = $airship->push()
       ->setAudience(P\deviceToken("ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff"))
       ->setNotification(P\notification("Hello from php!"))
       ->setDeviceTypes(P\all)
       ->send();

   print "Push sent!. Push IDs:" . $response.push_ids;



Contents:

.. toctree::
   :maxdepth: 2

   push.rst



Indices and tables
==================

* :ref:`genindex`
* :ref:`modindex`
* :ref:`search`


.. _uaapi: http://docs.urbanairship.com/reference/api/
.. _fig: http://www.php-fig.org/
