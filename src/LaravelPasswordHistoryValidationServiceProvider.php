<?php

namespace Infinitypaul\LaravelPasswordHistoryValidation;

use Illuminate\Support\ServiceProvider;
use Infinitypaul\LaravelPasswordHistoryValidation\Console\ClearOldPasswordHistory;
use Infinitypaul\LaravelPasswordHistoryValidation\Observers\UserObserver;

class LaravelPasswordHistoryValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/passwordHistory.php' => config_path('password-history-validation.php'),
            ], 'password-config');
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

            //Registering package commands.
            $this->commands([
                ClearOldPasswordHistory::class,
            ]);
        }
        $model = config('password-history.observe.model');
        class_exists($model) ?? $model::observe(UserObserver::class);
    }

    /**
     * Register the application services.
     */
    public function register()
    {

        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/passwordHistory.php', 'password-history');
    }
}
