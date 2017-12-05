<?php

namespace App\Models;

trait VerifyEmail
{
    public static function bootVerifyEmail()
    {
        static::creating(function ($user) {
            $user->email_token = str_random(30);
        });
    }

    public function verifyEmail()
    {
        $this->email_verified = true;
        $this->email_token = null;
        $this->save();
    }

    public function getVerifyFlashMessageAttribute()
    {
        return 'Email address was verified';
    }
}
