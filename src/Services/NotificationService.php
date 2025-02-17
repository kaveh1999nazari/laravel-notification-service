<?php

namespace Kaveh\NotificationService\Services;

use Kaveh\NotificationService\Abstracts\Authenticatable;
use Kaveh\NotificationService\Exceptions\NotFoundNotificationType;
use Kaveh\NotificationService\Models\NotificationChannel;
use Kaveh\NotificationService\Models\NotificationPreference;
use Kaveh\NotificationService\Models\NotificationType;

class NotificationService
{
    /**
     * @param string $notificationClass
     * @param Authenticatable $user
     * @param int $notificationTypeId
     * @param array|null $data
     * @return void
     * @throws NotFoundNotificationType
     */
    public static function sendNotification(string $notificationClass,
                                            Authenticatable $user,
                                            int $notificationTypeId,
                                            ?array $data = []): void
    {
        $notificationType = NotificationType::query()
            ->where('id', $notificationTypeId)
            ->first();
        if(! $notificationType) {
            throw new NotFoundNotificationType();
        }

        $activeChannels = NotificationPreference::query()
            ->where('user_id', $user->getId())
            ->where('notification_type_id', $notificationType->id)
            ->where('is_enabled', true)
            ->pluck('notification_channel_id')
            ->toArray();

        if (empty($activeChannels)) {
            return;
        }

        $channels = NotificationChannel::query()
            ->whereIn('id', $activeChannels)
            ->pluck('name')
            ->toArray();

        $user->notify(new $notificationClass($channels, $data));
    }
}