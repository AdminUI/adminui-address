<?php
namespace AdminUI\AdminUIAddress;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use AdminUI\AdminUIAddress\Classes\Address;
use AdminUI\AdminUIAddress\Classes\Distance;

class AdminUIAddressServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        // set schema length to prevent errors on old mysql
        Schema::defaultStringLength(255);

        // load view aliases
        Blade::include('components.address-block', 'addressBlock');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // add the facade
        $this->app->bind('address', function($app) {
            return new Address();
        });
        $this->app->bind('distance', function($app) {
            return new Distance();
        });

        // do the publish bits
        $this->publish();
        // do the migrations
        $this->migrate();
        // declare some routes
        $this->routes();
        // add some views
        $this->views();
    }

    public function publish()
    {
        $this->publishes([
                __DIR__.'/../build/config/adminuiaddress.php' => config_path('adminuiaddress.php'),
                __DIR__.'/Views/components' => resource_path('views/components'),
                __DIR__.'/../build/js' => public_path('vendor/adminui/js')
            ],
            'adminui-address'
        );
    }

    public function migrate()
    {
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
    }

    public function routes()
    {
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/Routes/api.php');
    }

    public function views()
    {
        $this->loadViewsFrom(__DIR__.'/Views', 'auiaddressviews');
        $this->loadViewsFrom(__DIR__.'/Views/Components', 'auiaddresscomponents');
    }
}
