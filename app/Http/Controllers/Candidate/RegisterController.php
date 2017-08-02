<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Requests\CandidateRegisterRequest;
use App\Models\Candidate;
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
        return view('app.candidate.register');
    }

    public function store(CandidateRegisterRequest $request)
    {
        $input = $request->only([
            'first_name',
            'last_name',
            'email',
            'password',
        ]);

        $input['password'] = bcrypt($input['password']);

        $candidate = Candidate::create($input);

        Log::info("Register: {$candidate->email} has registerd as a candidate");

        sendEmailActivationCandidate($candidate);

        return $this->getRegisteredResponse();
    }

    protected function getRegisteredResponse()
    {
        return redirect()->route('candidate.register')->with('registered', true);
    }
}
