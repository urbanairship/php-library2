PHP Script Example
==================

This example is a simple PHP script using the Urban Airship PHP library. It has
an example composer.json that fetches the library from Packagist.

Setup
-----

#. Use composer to fetch the library and dependencies defined in
   ``composer.json``, and install them::

      $ composer install

#. Edit the script, or copy it, and replace the ``$key`` and ``$secret``.
#. Enter in an iOS channel from a test device.
#. Run the script, which sends a push to your test device:

      $ php pushTest.php
