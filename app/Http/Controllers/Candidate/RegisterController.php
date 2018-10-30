<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Requests\CandidateRegisterRequest;
use App\Models\Candidate;
use Illuminate\Support\Facades\Auth;
use Log;

class RegisterController extends BaseController
{
    public function __construct()
    {
        //Overwrite auth middleware so anybody can register
        $this->middleware('guest');
    }

    public function index()
    {
        $user = new Candidate();

        if (session('socialUser')) {
            $user->fill(session('socialUser'));

            session()->forget('socialUser');
        }

        return view('app.candidate.register')->withUser($user);
    }

    public function store(CandidateRegisterRequest $request)
    {
        $input = $request->only([
            'first_name',
            'last_name',
            'email',
            'password',
        ]);
        $originalPassword = $input['password'];
        $input['password'] = bcrypt($input['password']);

        $candidate = Candidate::create($input);

        Log::info("Register: {$candidate->email} has registerd as a candidate");

        sendEmailActivationCandidate($candidate);

        loginUser($candidate);
        if(!isset($originalPassword) || empty($originalPassword)){
            session()->flash('warning','You have not set a password yet. You can set one at any time if you want to log in with email and password in the future');
        }
        return redirect($candidate->getHomeRoute());
    }
}
