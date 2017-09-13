<?php

namespace App\Http\Controllers\Candidate\Account\Profile\Register;

use App\Http\Requests\CandidateProfileRequest;
use App\Http\Controllers\Candidate\Account\Profile\BaseProfileController;

class ProfileController extends BaseProfileController
{
    public $editing = false;

    public function __construct()
    {
        $this->submitUrl = route('candidate.register.your-profile');
        $this->previousUrl = route('candidate.register.preferences');
        $this->nextLink = route('candidate.register.details');
       
        parent::__construct();
    }

    public function store(CandidateProfileRequest $request)
    {
        $input = $request->all();
        $user = $request->user();

        $this->save($user, $input);

        return redirect(route('candidate.register.details'));
    }
}
