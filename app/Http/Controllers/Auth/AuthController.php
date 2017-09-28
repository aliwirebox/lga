<?php

namespace App\Http\Controllers\Auth;

use App\Candidate;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use Socialite;

/**
 * This auth controller has been modifed from the default Laravel auth
 * controller to auth mulitple guards from one login form.
 */
class AuthController extends Controller
{
    use ThrottlesLogins,
        AuthenticatesUsers {
            logout as traitLogout;
            getCredentials as traitGetCredentials;
        }

    protected $guardList = [];

    protected $loginView = 'app.login';

    public function __construct()
    {
        $this->guardList = array_keys(config('auth.guards'));

        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * The majority of this is function is copied from the
     * Laravel trait https://github.com/laravel/framework/blob/5.2/src/Illuminate/Foundation/Auth/AuthenticatesUsers.php#L57.
     * It now has the addition of the guardList loop to attempt
     * a login against the different user tables.
     */
    public function login(Request $request)
    {
        unsetGuard();

        try {
            $this->validateLogin($request);
        } catch (ValidationException $e) {
            $e->response->setTargetUrl(url('login'));

            throw $e;
        }

        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            Log::info("Login: User {$request->input('email', '')} failed to login, user being throttled");

            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        foreach ($this->guardList as $guard) {
            $credentials = $this->getCredentials($request, $guard);

            if (Auth::guard($guard)->attempt($credentials, $request->has('remember'))) {
                setGuard($guard);

                Log::info("Auth: User $credentials[email] logs into $guard guard");

                return $this->handleUserWasAuthenticated($request, $throttles);
            }
        }

        if ($throttles && ! $lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        Log::info("Auth: User $credentials[email] failed to login, no match for credentials");

        return $this->sendFailedLoginResponse($request);
    }

    public function logout()
    {
        $user = getCurrentUser();

        if ($user) {
            Log::info(sprintf('Auth: User %s logs out of %s guard', $user->email, getGuard()));
        }
        
        $redirect = $this->traitLogout();

        unsetGuard();

        return $redirect;
    }

    public function redirectPath()
    {
        return getUserHomeRoute();
    }

    protected function getCredentials(Request $request, $guard)
    {
        $credentials = $this->traitGetCredentials($request);
        
        if (guardRequiresEmailVerification($guard)) {
            $credentials['email_verified'] = true;
        }

        return $credentials;
    }

    protected function setGuard($guard)
    {
        setGuard($guard);
    }

    /**
     * This overrides the trait function to use our global
     * function of the same name.
     */
    protected function getGuard()
    {
        return getGuard();
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect('login')
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }
    
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($socialProvider,$userType,$accessRoute)
    {
    session(['socialLogin' => ['userType' => $userType,'accessRoute' => $accessRoute]]);
        $driver = Socialite::driver($socialProvider);
        if($driver){
            return $driver->redirect();
        }
        abort(404);
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleLinkedinProviderCallback()
    {
        $socialiteUser = Socialite::driver('linkedin')->user();
        $socialUser = [
            'email' => $socialiteUser->email,
            'first_name' =>  $socialiteUser->user['firstName'],
            'last_name' =>  $socialiteUser->user['lastName'],
        ];
        return $this->loginSocialiteUserByEmail($socialUser, 'Linkedin');
    }

    /**
     * Login a user after Social account oAuth verification
     * @param type $socialUserEmail
     * @param type $socialProvider
     * @return type
     */
    public function loginSocialiteUserByEmail($socialUser, $socialProvider)
    {
        $providerList = config('auth.providers');
        $socialLogin = session('socialLogin');

        $user = null;

        foreach ($providerList as $provider) {
            $user = $provider['model']::whereEmail($socialUser['email'])->first();

            if ($user) {
                Log::info(sprintf('Auth: %s has verified their email address via %s', $user->email,$socialProvider));
                loginUser($user);
                session()->flash('message', 'Authorisation was verified');                  

                return redirect(getUserHomeRoute());
            }            
        }
        session(['socialUser' => $socialUser]);
        if($socialLogin['accessRoute'] === 'login'){
            session()->flash('error','We can\'t find a user that matches your<br />' . ucfirst($socialProvider) . ' details.<br />You can register now with these details or if you already have an account, <a href="/login">login</a> with the email you provided at registration');
        }
        else {
             session()->flash('success','Authenticated with ' . ucfirst($socialProvider) . '.<br />Please check the details and enter your new password to complete registration');
        }
        Log::info("Auth: Failed to verify account for {$socialUser['email']} via $socialProvider. Requesting user to register");
        return redirect("register/{$socialLogin['userType']}");
    }
    
}
