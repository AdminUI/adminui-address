<?php
// Front and backend routes
Route::group([
    'namespace' => 'AdminUI\AdminUIAddress\Controllers',
    'middleware' => ['web'],
], function() {
    Route::view('test', 'auiaddress::test');
});

