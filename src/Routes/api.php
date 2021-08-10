<?php

use AdminUI\AdminUIAddress\Api\AddressApiController;
use GuzzleHttp\Middleware;

Route::group(
    [
        'middleware' => ['web'],
    ],
    function () {

        // Address lookup
        Route::post('address/lookup-poscode', [AddressApiController::class, 'lookupPostcode'])->name('address.lookup-poscode');
    }
);
