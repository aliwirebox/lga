<?php

namespace App\Http\Controllers\Candidate\Account\Details\Register;

use App\Http\Requests\CandidateDetailsRequest;
use App\Http\Controllers\Candidate\Account\Details\BaseDetailsController;

class DetailsController extends BaseDetailsController
{
    public $editing = false;

    public function __construct()
    {
        $this->submitUrl = route('candidate.register.details');
        $this->previousUrl = route('candidate.register.your-profile');
        $this->nextLink = route('candidate.register.cv');

        parent::__construct();
    }

    public function store(CandidateDetailsRequest $request)
    {
        $this->save($request->user(), $request->all());

        return redirect(route('candidate.register.cv'));
    }
}
