<?php

namespace App\Http\Controllers\Auth;

use App\Candidate;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use Socialite;

class AuthController extends Controller
{
    protected $guardList = [];

    protected $loginView = 'app.login';

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->guardList = ['candidates', 'hirers', 'brand_admins'];

        $this->middleware('guest', ['except' => 'logout']);
    }

    public function getLogin()
    {
        return view($this->loginView);
    }

    public function login(Request $request)
    {
        unsetGuard();

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        //$credentials['email_verified'] = true;

        foreach ($this->guardList as $guard) {
            if (Auth::guard($guard)->attempt($credentials, $request->has('remember'))) {
                setGuard($guard);

                Log::info("Auth: User $credentials[email] logs into $guard guard");

                $request->session()->regenerate();

                return redirect()->intended($this->redirectPath());
            }
        }

        Log::info("Auth: User $credentials[email] failed to login, no match for credentials");

        return redirect('login')
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => 'These credentials do not match our records.',
            ]);
    }

    public function logout(Request $request)
    {
        $user = getCurrentUser();

        if ($user) {
            Log::info(sprintf('Auth: User %s logs out of %s guard', $user->email, getGuard()));
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        unsetGuard();

        return redirect('/');
    }

    public function redirectPath()
    {
        return getUserHomeRoute();
    }

    protected function getCredentials(Request $request, $guard)
    {
        $credentials = $request->only('email', 'password');
        $credentials['email_verified'] = true;

        if (guardRequiresEmailVerificationBeforeLogin($guard)) {
            $credentials['email_verified'] = true;
        }

        return $credentials;
    }

    public function redirectToProvider($socialProvider, $userType, $accessRoute)
    {
        session(['socialLogin' => ['userType' => $userType,'accessRoute' => $accessRoute]]);

        $driver = Socialite::driver($socialProvider);

        if ($driver) {
            return $driver->redirect();
        }

        abort(404);
    }

    public function handleLinkedinProviderCallback()
    {
        $socialiteUser = Socialite::driver('linkedin')->user();

        $socialUser = [
            'email'      => $socialiteUser->email,
            'first_name' => $socialiteUser->user['firstName'],
            'last_name'  => $socialiteUser->user['lastName'],
        ];

        return $this->loginSocialiteUserByEmail($socialUser, 'Linkedin');
    }

    public function loginSocialiteUserByEmail($socialUser, $socialProvider)
    {
        $providerList = config('auth.providers');
        $socialLogin = session('socialLogin');

        $user = null;

        foreach ($providerList as $provider) {
            $user = $provider['model']::whereEmail($socialUser['email'])->first();

            if ($user) {
                Log::info(sprintf('Auth: %s has verified their email address via %s', $user->email, $socialProvider));
                loginUser($user);
                session()->flash('message', 'Authorisation via '. ucfirst($socialProvider) . ' verified');

                return redirect(getUserHomeRoute());
            }
        }

        session()->flash('socialUser', $socialUser);
        session()->flash('socialRegister',true);

        if ($socialLogin['accessRoute'] === 'login') {
            $message = 'Your '. ucfirst($socialProvider) . ' address is not registered.<br>Please check your details are correct and click Register now.<br />'.
                   '<small><i>If you are already registered under a different email address, please go to <a href="/login">login</a> and use that address.<br />'.
                    'If you want to login with '. ucfirst($socialProvider) . ' in the future, the registered email on '. ucfirst($socialProvider) . ' and Legal Asset must be the same.</small></i>';
            session()->flash('warning', $message);
        } else {
            session()->flash('success', 'Authenticated with ' . ucfirst($socialProvider) . '.<br />Please check the details and enter your new password to complete registration');
        }

        Log::info("Auth: Failed to verify account for {$socialUser['email']} via $socialProvider. Requesting user to register");

        return redirect("register/{$socialLogin['userType']}#{$socialLogin['userType']}-tab");
    }
}
