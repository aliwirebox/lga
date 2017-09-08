<?php

namespace App\Providers;

use App\Models\Candidate;
use App\Models\Hirer;
use Event;
use Illuminate\Support\ServiceProvider;
use Log;

class LoginAsAdminProvider extends ServiceProvider
{
    public function boot()
    {
        $checkForAdmin = function ($user) {
            if (session()->has('acting.brand_admin.email')) {
                Log::info("Admin " . session('acting.brand_admin.email') . " is editing on behalf of {$user->email}");
                $user->timestamps = false;
            }
        };

        Candidate::saving($checkForAdmin);

        Hirer::saving($checkForAdmin);

        Event::listen('Illuminate\Auth\Events\Logout', function () {
            app('session')->forget('acting.brand_admin.email');
        });
    }

    public function register()
    {
        //
    }
}
