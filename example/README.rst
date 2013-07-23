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
#. Run the script, which sends a broadcast to all devices::

      $ php pusher.php
