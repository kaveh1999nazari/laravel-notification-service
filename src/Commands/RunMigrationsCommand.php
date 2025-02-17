<?php

namespace Kaveh\NotificationService\Commands;

use Illuminate\Console\Command;

class RunMigrationsCommand extends Command
{
    protected $signature = 'notification-service:migrate';
    protected $description = 'Run migrations for NotificationService package';

    public function handle(): void
    {
        $this->info('Running migrations for NotificationService...');

        $this->call('migrate', [
            '--path' => 'vendor/kaveh/notification-service/src/Migrations',
            '--force' => true
        ]);

        $this->info('NotificationService migrations executed successfully.');
    }
}