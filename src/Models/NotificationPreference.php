<?php

namespace Kaveh\NotificationService\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'notification_type_id',
        'notification_channel_id',
        'is_enabled',
        'is_user_modifiable'
    ];
}