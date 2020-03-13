<?php
namespace AdminUI\AdminUIAddress\Facades;

use Illuminate\Support\Facades\Facade;

class Address extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'GetAddress';
    }
}
