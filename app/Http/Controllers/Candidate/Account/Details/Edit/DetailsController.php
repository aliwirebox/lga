<?php

namespace App\Http\Controllers\Candidate\Account\Details\Edit;

use App\Http\Requests\CandidateDetailsRequest;
use App\Http\Controllers\Candidate\Account\Details\BaseDetailsController;

class DetailsController extends BaseDetailsController
{
    public $editing = true;

    public function __construct()
    {
        $this->submitUrl = route('candidate.profile.details');
        $this->previousUrl = false;

        parent::__construct();
    }

    public function store(CandidateDetailsRequest $request)
    {
        $this->save($request->user(), $request->all());

        return redirect(route('candidate.profile'));
    }
}
