<?php
namespace AdminUI\AdminUIAddress;

use AdminUI\Framework\Provider;

class AdminUIAddressServiceProvider extends Provider
{
    public $viewPrefix = 'auiaddress';
    public $dir        = __DIR__;
    public $namespace  = __NAMESPACE__;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function _boot(\Illuminate\Routing\Router $router)
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function _register()
    {
        $this->loadMigrationsFrom($this->dir.'/Database/Migrations');
    }
}
