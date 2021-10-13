<?php
// mariojgt test
Route::group(
    [
        'namespace' => 'AdminUI\AdminUIAddress\Api'
    ], function () {
        // address lookup
        Route::get('address/lookup', 'AddressApiController@lookup')
            ->name('api.address.lookup');
    }
);
