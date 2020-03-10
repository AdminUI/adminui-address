<?php
return [
    // GetAddress.io API Key
    'apiKey' => env('AUI_ADDRESS_APIKEY', ''),

    // GetAddress.io Admin API Key
    'adminKey' => env('AUI_ADDRESS_ADMINKEY', ''),

    // How long each postcode gets stored in cache in seconds
    'cacheTime' => env('AUI_ADDRESS_CACHETIME', '604800'),

    // Default Longtitude to calculate against distance
    'lng' => env('AUI_ADDRESS_LNG', '0.1278'),

    // Default Latitude to calculate against distance
    'lat' => env('AUI_ADDRESS_LAT', '51.5074')
];
