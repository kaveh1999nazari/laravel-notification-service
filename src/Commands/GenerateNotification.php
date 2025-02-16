<?php

namespace Kaveh\NotificationService\Commands;


use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class GenerateNotification extends Command
{
    protected $signature = 'make:notification-service {name}';
    protected $description = 'Generate a custom notification extending BaseNotification';

    public function handle(): void
    {
        $name = $this->argument('name');

        $stub = <<<PHP
<?php

namespace App\Notifications;

use YourNamespace\NotificationService\Notifications\BaseNotification;
use Illuminate\Notifications\Messages\MailMessage;

class {$name} extends BaseNotification
{
    public function __construct(array \$channels, array \$data)
    {
        parent::__construct(\$channels);
    }

    public function toMail(object \$notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Notification')
            ->line('This is a new notification');
    }

    public function toArray(object \$notifiable): array
    {
        return [
            'message' => 'New Notification'
        ];
    }
}
PHP;

        $path = app_path("Notifications/{$name}.php");
        if (file_exists($path)) {
            $this->error("Notification {$name} already exists!");
            return;
        }
        (new Filesystem())->put($path, $stub);

        $this->info("Notification {$name} created successfully.");
    }
}