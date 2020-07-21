# AdminUI UK Address Lookup for Laravel ^7.0


This package is built for use within the AdminUI Framework, However due to the needs across multiple systems
it can be run on any Laravel 7+ project.

## Requirements

**Laravel 7 package**<br>
**Jquery**<br>
**[GetAddress.io](https://getaddress.io) api key**<br>

## Installation

    composer require adminui/adminui-address

Once installed Laravel with auto-find the package.

This package uses Laravel HTTP class to get results from getaddress.io

The package does come with a Countries migration and seed and also a US State Migration and seed.<br>
The Country table contains a few extra fields, iso codes, postcode requirement, dial code and status.<br>
If the status is 0 it will not be selectable, hence restricting certain countries if need be.<br>
If postcode is 1 the postcode field will be required.

Please run :

    php artisan vendor:publish --tag adminui-address
    php artisan migrate
    php artisan db:seed --class=AdminUI\AdminUIAddress\Database\Seeds\DatabaseSeeder

Once done you will need to update the config file 'adminuiaddress' or add the following variables to the
.env file:

    AUI_ADDRESS_APIKEY=""
    AUI_ADDRESS_ADMINKEY=""
    AUI_ADDRESS_CACHETIME=""
    AUI_ADDRESS_LNG=""
    AUI_ADDRESS_LAT=""
    AUI_UNIT="M"

The address component has been moved to your views/components folder.<br>
And its JS for the blade component to public/vendor/adminui/address-block.js<br/>
It can be easily called using

    @addressBlock()

If the UK is chosen it gives you the opportunity to do a postcode lookup.
The lookup will appear in a dropdown if postcode is found.
Once address is chosen a full address block appears.

The system uses Laravels caching to store postcode results, to save repeat lookups.

Please ensure to add in Jquery to your template.
Also please add

    @stack('scripts')

This will allow the required Javascript to be pushed below the Jquery call.

## Distance Helper Class

The package comes with a distance helper class.
This can calculate the distance from your 'lat/lng' (as per config) to the address you have just got from
the postcode lookup script.

Simply call the class with the variables and measurement unit, and the resulting distance will be returned

    use Distance;
    ...
    $distance  =  round(Distance::between(['lng'  => request('lng'),  'lat'  => request('lat')]), 2);

This will take 3 parameters:<br>
**TO** - array [lng, lat]<br>
**FROM** - array[lng, lat] optional, by default this is lng and lat setup in env or config file<br>
<br>
Distance can be returned in 3 units of measurement.
M - Miles ** Default **
KM - Kilometers
NM - Nautical Miles
This can be set within the .env or directly in config file.

Distance is returned.

Credit given to : <br>
[altrozero/](https://packagist.org/packages/altrozero/)get-address-io-php<br>
for some of the coding structure.

**Still to come in next branch:**<br>
Add some Admin Functionality for Whitelist, Blacklist, Invoices

*Enjoy.*
