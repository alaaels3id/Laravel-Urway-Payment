<?php

namespace Alaaelsaid\LaravelUrwayPayment\Providers;

use Illuminate\Support\ServiceProvider;
use Alaaelsaid\LaravelUrwayPayment\Facade\UrwayProcess;

class UrwayServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $ds = DIRECTORY_SEPARATOR;

        $this->publishes([__DIR__ . $ds .'..'. $ds .'..' . $ds .'config'.$ds.'urway.php' => config_path('urway.php')],'urway');
    }

    public function register()
    {
        $ds = DIRECTORY_SEPARATOR;

        $this->app->singleton('Urway', fn() => new UrwayProcess());

        $this->mergeConfigFrom(__DIR__ . $ds .'..'. $ds .'..' . $ds .'config'.$ds.'urway.php','urway');
    }
}
