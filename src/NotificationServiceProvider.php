<?php

namespace Kaveh\NotificationService;

use Illuminate\Support\ServiceProvider;
use Kaveh\NotificationService\Commands\GenerateNotification;

class NotificationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateNotification::class,
            ]);

            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

            $this->publishes([
                __DIR__.'/../database/migrations/' => database_path('migrations'),
            ], 'migrations');

            $this->publishes([
                __DIR__.'/../config/notification.php' => config_path('notification.php'),
            ], 'config');
        }
    }
}