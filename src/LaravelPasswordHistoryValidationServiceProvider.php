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
                __DIR__.'/../config/passwordHistory.php' => config_path('password-history.php'),
            ], 'password-config');

            $this->publishes([
                __DIR__ . '/../database/migrations/2019_12_02_141717_create_password_history_table.php' => database_path('migrations/' . date('Y_m_d_His') . '_create_password_history_table.php'),
            ], 'password-migrations');
            
            //Registering package commands.
            $this->commands([
                ClearOldPasswordHistory::class,
            ]);
        }
        
        $publishedMigration = glob(database_path('migrations/*_create_password_history_table.php'));
        if (empty($publishedMigration)) {
            // Automatically load migrations only if they have not been published
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }
        
        $model = config('password-history.observe.model');
        class_exists($model) ? $model::observe(UserObserver::class) : null;
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
