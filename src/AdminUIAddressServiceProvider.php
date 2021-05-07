<?php

namespace AdminUI\AdminUIAddress;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use AdminUI\AdminUIAddress\Classes\Address;
use AdminUI\AdminUIAddress\Classes\Distance;
use AdminUI\AdminUIFramework\Provider;

class AdminUIAddressServiceProvider extends Provider
{
    public $viewPrefix = 'auiaddress';
    public $dir        = __DIR__;
    public $namespace  = __NAMESPACE__;

    public function _boot(\Illuminate\Routing\Router $router)
    {
    }

    public function _register()
    {
        $this->publish();
    }

    public function publish()
    {
        // Publish the langage file
        $this->publishes([
            __DIR__ . '/../Publish/lang' => resource_path('/lang/')
        ]);

        $this->publishes([
            __DIR__ . '/../Publish/js' => resource_path('/vendor/addresses')
        ]);

        // // Controllers Email Notifications Models provides and everting else
        // $this->publishes([
        //     __DIR__.'/../Publish/App' => app_path('/')
        // ]);

        // // Routes override
        // $this->publishes([
        //     __DIR__.'/../Publish/Routes' => base_path('/routes')
        // ]);

        // // Database migrations
        // $this->publishes([
        //     __DIR__.'/../Publish/Database' => database_path('/')
        // ]);

        // // Publish the docs
        // $this->publishes([
        //     __DIR__.'/../Publish/Docs' => base_path('/docs')
        // ]);

        // // Publish the compiled js and css to the public folder
        // $this->publishes([
        //     __DIR__.'/../Publish/publicFolder' => public_path('/vendor/AUIEcommerce')
        // ]);

        // // Publish the npm mix to the root folder
        // $this->publishes([
        //     __DIR__.'/../Publish/NpmMix/' => base_path('/')
        // ]);

        // // Config pusblish
        // $this->publishes([
        //     __DIR__.'/../Publish/Config/' => base_path('config/')
        // ]);

        //use php artisan vendor:publish --force
    }
}
