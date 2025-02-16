<?php

namespace Kaveh\NotificationService\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

abstract class BaseNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly array $channels)
    {
    }

    public function via(object $notifiable): array
    {
        return $this->channels;
    }

    abstract public function toMail(object $notifiable): MailMessage;

    abstract public function toArray(object $notifiable): array;
}
