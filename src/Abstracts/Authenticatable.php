<?php

namespace Kaveh\NotificationService\Abstracts;

use Illuminate\Foundation\Auth\User;


abstract class Authenticatable extends User
{
    abstract public function getId();
}