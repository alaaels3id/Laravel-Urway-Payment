<?php

namespace Alaaelsaid\LaravelUrwayPayment\Providers;

use Illuminate\Support\ServiceProvider;
use Alaaelsaid\LaravelUrwayPayment\Facade\UrwayProcess;

class UrwayServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([__DIR__ . '/../../../config/urway.php' => config_path('urway.php')],'urway');
    }

    public function register()
    {
        $this->app->singleton('Urway', fn() => new UrwayProcess());

        $this->mergeConfigFrom(__DIR__ . '/../../config/urway.php','urway');
    }
}
