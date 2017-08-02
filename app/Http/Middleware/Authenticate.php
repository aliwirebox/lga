<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($this->isApiRequest($request)) {
                return abort(401);
            } elseif ($this->isLoggedIn($request)) {
                return abort(403);
            } else {
                return redirect()->guest('login');
            }
        }

        /*
         * Set the guard of the current user as defualt
         * so it doesnt need to be passed every time to
         * classes like Auth and Gate
         */
        $this->setDefaultGuard($guard);

        return $next($request);
    }

    protected function isLoggedIn($request)
    {
        return session('guard');
    }

    protected function isApiRequest($request)
    {
        return $request->ajax() || $request->wantsJson();
    }

    protected function setDefaultGuard($guard)
    {
        config()->set('auth.defaults.guard', $guard);
    }
}
