<?php

namespace App\Http\Controllers\Candidate\Account\Cv\Register;

use App\Http\Controllers\Candidate\Account\Cv\BaseCvController;
use App\Http\Requests\CandidateCvRequest;

class CvController extends BaseCvController
{
    public $editing = false;

    public function __construct()
    {
        $this->submitUrl = route('candidate.register.cv');
        $this->previousUrl = route('candidate.register.preferences');
        $this->nextLink = route('candidate.register.review');

        parent::__construct();
    }

    public function store(CandidateCvRequest $request)
    {
        $cv = $request->file('cv');

        $this->save($request->user(), $cv);

        if ($request->wantsJson()) {
            return response()->json(['data' => ['cv' => $cv->getClientOriginalName()]]);
        }

        return redirect(route('candidate.register.review'));
    }
}
