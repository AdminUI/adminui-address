<?php
namespace AdminUI\AdminUIAddress;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use AdminUI\AdminUIAddress\Classes\Address;
use AdminUI\AdminUIAddress\Classes\Distance;
use AdminUI\AdminUIAddress\Facades\AddressFacade;
use AdminUI\AdminUIAddress\Facades\DistanceFacade;

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
        $this->app->bind('GetAddress', function($app) {
            return new Address();
        });
        $this->app->bind('GetDistance', function($app) {
            return new Distance();
        });

        // add the aliases
        $this->app->alias('AddressFacade', AddressFacade::class);
        $this->app->alias('DistanceFacade', DistanceFacade::class);

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
                __DIR__.'/../build/components' => resource_path('views/components')
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
