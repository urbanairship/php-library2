Retrieving Device Information
=============================

Device Listing
--------------

Device lists are fetched by instantiating an iterator using the :namespace:`UrbanAirship\\Devices\\DeviceListing` namespace. Can set parameter ``limit``, which sets the number of entries to fetch in each page request.

This example performs a Channel Listing:

.. code-block:: php

   require_once 'vendor/autoload.php';

   use Urbanairship\Airship;
   use UrbanAirship\Push as P;

   $airship = new Airship("key", "secret");

   $chans = $airship->listChannels();
   foreach ($chans as $chan) {
       var_export($chan);
   }

Device Lookup
-------------

Device metadata is fetched for a specific device by using the :namespace:`UrbanAirship\\Devices\\DeviceLookup` namespace.

This example performs a Channel Lookup:

.. code-block:: php

   require_once 'vendor/autoload.php';

   use Urbanairship\Airship;
   use UrbanAirship\Push as P;

   $airship = new Airship("key", "secret");

   $chan = $airship->channelLookup("Insert your channel here!")
        ->channelInfo();
   var_export($chan);