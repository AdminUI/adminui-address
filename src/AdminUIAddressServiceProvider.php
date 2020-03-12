<?php
namespace AdminUI\AdminUIAddress;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

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
        Blade::include('components.addressBlock', 'addressBlock');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->publish();
        $this->migrate();
        $this->routes();
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
