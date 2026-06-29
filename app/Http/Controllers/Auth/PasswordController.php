<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Log;

class PasswordController extends Controller
{
    protected $linkRequestView = 'app.password.email';

    protected $resetView = 'app.password.reset';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        return view($this->linkRequestView);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $email = $request->input('email');
        $broker = $this->getBroker($email);

        $response = Password::broker($broker)->sendResetLink(
            $request->only('email')
        );

        switch ($response) {
            case Password::RESET_LINK_SENT:
                Log::info("Auth: Sending reset password link to $email");
                return redirect()->back()->with('status', trans($response));

            case Password::INVALID_USER:
            default:
                Log::info("Auth: Not sending reset password link. No user found for $email");
                return redirect()->back()
                    ->withErrors(['email' => trans($response)])
                    ->withInput();
        }
    }

    public function showResetForm(Request $request, $token = null)
    {
        if ($token) {
            return view($this->resetView)->with([
                'token' => $token,
                'email' => $request->input('email'),
            ]);
        }

        return view($this->resetView)->with([
            'token' => $request->route('token'),
            'email' => $request->input('email'),
        ]);
    }

    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password', 'password_confirmation', 'token');
        $email = $request->input('email');
        $broker = $this->getBroker($email);

        $response = Password::broker($broker)->reset($credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                Log::info("Auth: Resetting password for $email");
                return $this->getResetSuccessResponse($response);

            default:
                Log::info("Auth: Failed to reset password for $email", [$response]);
                return redirect()->back()
                    ->withErrors(['email' => trans($response)])
                    ->withInput();
        }
    }

    protected function resetPassword($user, $password)
    {
        $user->password = bcrypt($password);
        $user->save();
    }

    public function getBroker($email)
    {
        return getBrokerForEmail($email);
    }

    public function redirectPath()
    {
        return getUserHomeRoute();
    }

    protected function getGuard()
    {
        return getGuard();
    }
}
