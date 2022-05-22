<?php

namespace ToneflixCode\Cuttly;

use Illuminate\Support\ServiceProvider;

class CuttlyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('cuttly.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'cuttly');

        // Register the main class to use with the facade
        $this->app->singleton('cuttly-laravel', function () {
            return new Cuttly;
        });
    }
}