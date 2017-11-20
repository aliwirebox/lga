<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Log;

class VerifyEmailController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function verifyEmail($token)
    {
        $providerList = config('auth.providers');

        $user = null;

        foreach ($providerList as $provider) {
            if (providerRequiresEmailVerification($provider)) {
                $user = $provider['model']::whereEmailToken($token)->first();

                if ($user) {
                    $user->verifyEmail();
                    Log::info(sprintf('Auth: %s has verified their email address', $user->email));
                    loginUser($user);
                    session()->flash('message', 'Email address was verified');

                    if (getUserType() == "hirer") {
                        sendEmailWelcomeHirer($user);
                    }
                    
                    return redirect(getUserHomeRoute());
                }
            }
        }

        Log::info("Auth: Failed to verify a email address for token: $token");

        abort(404);
    }
}
