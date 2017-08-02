<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

abstract class BaseUser extends Authenticatable
{
    public function getFullName()
    {
        return sprintf('%s %s', $this->first_name, $this->last_name);
    }

    abstract public function getHomeRoute();

    public function getNotificationCount()
    {
        return 0;
    }
}
