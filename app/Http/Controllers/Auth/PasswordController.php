<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Log;

class PasswordController extends Controller
{
    use ResetsPasswords {
        resetPassword as traitResetPassword;
    }

    protected $linkRequestView = 'app.password.email';

    protected $resetView = 'app.password.reset';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getBroker($email)
    {
        return getBrokerForEmail($email);
    }

    public function redirectPath()
    {
        return getUserHomeRoute();
    }

    /**
     * This function is mostly a copy from https://github.com/laravel/framework/blob/5.2/src/Illuminate/Foundation/Auth/ResetsPasswords.php#L195
     * The only change is we pass the email address to the getBroker function
     */
    public function reset(Request $request)
    {
        $this->validate(
            $request,
            $this->getResetValidationRules(),
            $this->getResetValidationMessages(),
            $this->getResetValidationCustomAttributes()
        );

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $email = $request->input('email');
        $broker = $this->getBroker($email);

        $response = Password::broker($broker)->reset($credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                Log::info("Auth: Resetting password for $email");

                $user = Password::broker($broker)->getUser($credentials);

                $user->verifyEmail();

                sendEmailPasswordChanged($user);
                
                return $this->getResetSuccessResponse($response);

            default:
                Log::info("Auth: Failed to reset password for $email", [$response]);
                return $this->getResetFailureResponse($request, $response);
        }
    }

    /**
     * This function is mostly a copy from https://github.com/laravel/framework/blob/5.2/src/Illuminate/Foundation/Auth/ResetsPasswords.php#L72
     * The only change is we pass the email address to the getBroker function
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
        $email = $request->input('email');
        $broker = $this->getBroker($email);

        $response = Password::broker($broker)->sendResetLink(
            $request->only('email'), $this->resetEmailBuilder()
        );

        switch ($response) {
            case Password::RESET_LINK_SENT:
                Log::info("Auth: Sending reset password link to $email");
                return $this->getSendResetLinkEmailSuccessResponse($response);

            case Password::INVALID_USER:
            default:
                Log::info("Auth: Not sending reset password link. No user found for $email");
                return $this->getSendResetLinkEmailFailureResponse($response);
        }
    }

    /**
     * This overrides the trait function to use our global
     * function of the same name.
     */
    protected function getGuard()
    {
        return getGuard();
    }

    protected function resetPassword($user, $password)
    {
        $guard = getGuardForUserOrDefault($user);

        setGuard($guard);

        $this->traitResetPassword($user, $password);
    }
}
