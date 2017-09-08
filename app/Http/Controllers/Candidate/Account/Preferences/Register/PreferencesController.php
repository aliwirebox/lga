<?php

namespace App\Http\Controllers\Candidate\Account\Preferences\Register;

use App\Http\Requests\CandidatePreferencesRequest;
use App\Http\Controllers\Candidate\Account\Preferences\BasePreferencesController;

class PreferencesController extends BasePreferencesController
{
    public $editing = false;

    public function __construct()
    {
        $this->submitUrl = route('candidate.register.preferences');
        $this->previousUrl = false;
        $this->nextLink = route('candidate.register.your-profile');

        parent::__construct();
    }

    public function store(CandidatePreferencesRequest $request)
    {
        $input = $request->all();
        $user = $request->user();

        $this->save($user, $input);

        return redirect(route('candidate.register.your-profile'));
    }
}
