<?php

namespace Kaveh\NotificationService\Commands;

use Illuminate\Console\Command;

class PublishMigrationsCommand extends Command
{
    protected $signature = 'notification-service:publish-migrations';
    protected $description = 'Publish migrations for NotificationService package';

    public function handle(): void
    {
        $this->call('vendor:publish', [
            '--tag' => 'migrations',
            '--force' => true
        ]);

        $this->info('NotificationService migrations published successfully.');
    }
}