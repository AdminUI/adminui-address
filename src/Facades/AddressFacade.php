<?php
namespace AdminUI\AdminUIAddress\Facades;

use Illuminate\Support\Facades\Facade;

class AddressFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'address';
    }
}
