**AdminUI UK Address Lookup for Laravel ^7.0**


This package is built for use within the AdminUI Framework, However due to the needs across multiple systems
it can be run on any Laravel 7+ project.

**Requirements:**

Laravel 7 package

Jquery

[GetAddress.io](https://getaddress.io) api key

**Installation**

    composer require adminui/adminui-address

Once installed Laravel with auto-find the package.

This package uses Laravel HTTP class to get results from getaddress.io

The package does come with a Countries migration and seed.

    php artisan vendor:publish --tag adminui-address
    php artisan migrate
    php db:seed --class=AdminUI\AdminUIAddress\Database\Seeds\DatabaseSeeder

Once done you will need to update the config file 'adminui-address' or add the following variables to the
.env file:

    AUI_ADDRESS_APIKEY=""
    AUI_ADDRESS_ADMINKEY=""
    AUI_ADDRESS_CACHETIME=""
    AUI_ADDRESS_LNG=""
    AUI_ADDRESS_LAT=""

The address component has been moved to your views/components folder.

It can be easily called using

    @addressBlock()

If the UK is chosen it gives you the opportunity to do a postcode lookup.

The lookup will appear in a dropdown if postcode is found.

Once address is chosen a full address block appears.

The system uses Laravels caching to store postcode results, to save repeat lookups.

The package comes with a distance helper class.

This can calculate the distance from your 'lat/lng' (as per config) to the address you have just got from

the postcode lookup script.

Simply call the class with the variables and measurement unit, and the resulting distance will be returned

    use AdminUI\AdminUIAddress\Helpers\Distance;
    ...
    $distance  =  round(Distance::between(['lng'  => request('lng'),  'lat'  => request('lat')], 'KM'), 2);

This will take 3 parameters,

TO - array [lng, lat]

UNIT - measurement optional, KM - Kilometers, NM - Nautical Miles, M - Miles*

FROM - array[lng, lat] optional, by default this is lng and lat setup in env or config file

Distance is returned.

Credit given to : ## [altrozero/](https://packagist.org/packages/altrozero/)get-address-io-php

for some of the coding structure.

**Still to come:**

Add some Admin Functionality for Whitelist, Blacklist, Invoices

Enjoy.
