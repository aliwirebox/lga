<?php

namespace App\Http\Controllers\Candidate\Account\Profile\Edit;

use App\Http\Requests\CandidateProfileRequest;
use App\Http\Controllers\Candidate\Account\Profile\BaseProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProfileController extends BaseProfileController
{
    public $editing = true;

    public function __construct(Request $request)
    {
        $this->submitUrl = route('candidate.profile.your-profile');
        $this->previousUrl = false;

        parent::__construct();
    }


    public function index(Request $request)
    {
        $candidate = $request->user();
        $this->isEmployedByTraingFirm = getCandidateEmployedByTrainingFirmText($candidate);

        return parent::index($request);
    }


    public function store(CandidateProfileRequest $request)
    {
        $input = $request->all();
        $user = $request->user();

        $this->save($user, $input);

        return redirect(route('candidate.profile'));
    }
}
