<?php

namespace App\Http\Controllers\Candidate\Account\Cv\Edit;

use App\Http\Controllers\Candidate\Account\Cv\BaseCvController;
use App\Http\Requests\CandidateCvRequest;

class CvController extends BaseCvController
{
    public $editing = true;

    public function __construct()
    {
        $this->submitUrl = route('candidate.profile.cv');
        $this->nextLink = route('candidate.profile');

        parent::__construct();
    }

    public function store(CandidateCvRequest $request)
    {
        $cv = $request->file('cv');

        $this->save($request->user(), $cv);

        if ($request->wantsJson()) {
            return response()->json(['data' => ['cv' => $cv->getClientOriginalName()]]);
        }

        return redirect(route('candidate.profile'));
    }
}
