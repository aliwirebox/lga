<?php

namespace App\Http\Controllers\Candidate\Account\Preferences\Edit;

use App\Http\Requests\CandidatePreferencesRequest;
use App\Http\Controllers\Candidate\Account\Preferences\BasePreferencesController;

class PreferencesController extends BasePreferencesController
{
    public $editing = true;

    public function __construct()
    {
        $this->submitUrl = route('candidate.profile.preferences');
        $this->previousUrl = false;

        parent::__construct();
    }

    public function store(CandidatePreferencesRequest $request)
    {
        $input = $request->all();
        $user = $request->user();

        $this->save($user, $input);

        return redirect(route('candidate.profile'));
    }
}
