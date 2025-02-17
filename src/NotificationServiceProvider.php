<?php

namespace Kaveh\NotificationService;

use Illuminate\Support\ServiceProvider;
use Kaveh\NotificationService\Commands\GenerateNotification;
use Kaveh\NotificationService\Commands\RunMigrationsCommand;

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
                RunMigrationsCommand::class,
            ]);

            $this->publishes([
                __DIR__.'/Migrations/' => database_path('migrations'),
            ], 'migrations');

            $this->publishes([
                __DIR__.'/../config/notification.php' => config_path('notification.php'),
            ], 'config');
        }
    }
}