<?php

namespace App\Models;

class NqAdmin extends BaseUser
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    public function getUserType()
    {
        return 'nq-admin';
    }

    public function getHomeRoute()
    {
        return route('nq-admin.dashboard');
    }

    public function getNotificationCount()
    {
        return NqAdminMatchQuery::getCvPendingMatches()->get()->count();
    }

    /**
     * On line 66 in the PasswordController
     * we need to verify emails for hirers and
     * candidates. To support this I implemented
     * a empty function for admins. issue#447
     */
    public function verifyEmail()
    {
        //do nothing;
    }
}
