<?php

namespace Omaralalwi\LaravelPy;

use Omaralalwi\PhpPy\Managers\ConfigManager;
use Illuminate\Support\ServiceProvider;
use Omaralalwi\PhpPy\PhpPy;

class LaravelPyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/laravelPy.php' => config_path('laravel-py.php'),
            ], 'laravel-py');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravelPy.php', 'laravel-py');

        $this->app->singleton('LaravelPy', function ($app) {
            $config = $app['config']['laravel-py'];
            $configManager = new ConfigManager([
                'scripts_directory' => $config['scripts_directory'],
                'python_executable' => $config['python_executable'],
                'max_timeout' => $config['max_timeout'],
            ]);

            return PhpPy::build()
                ->setConfig($configManager);
        });
    }

}
