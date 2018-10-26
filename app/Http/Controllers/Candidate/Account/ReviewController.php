<?php

namespace App\Http\Controllers\Candidate\Account;

use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Http\Requests\GoLiveRequest;
use Illuminate\Support\Facades\Log;

class ReviewController extends BaseAccountController
{
    public function index(Request $request)
    {
        $candidate = $request->user();

        if (empty($candidate->cv_name)) {
            return redirect()->back()->withErrors(['Upload a CV before continuing']);
        }

        Log::info("Candidate: {$candidate->email} views review and go live page");

        if ($candidate->is_live) {
            return $this->redirectLiveCandidate($candidate);
        }

        return view('app.candidate.profile.review', ['candidate' => $candidate]);
    }

    protected function redirectLiveCandidate($candidate)
    {
        Log::warning("Candidate: {$candidate->email} profile is already live. redirecting candidate");
        return redirect(route('candidate.dashboard'));
    }

    public function store(GoLiveRequest $request)
    {
        $input = $request->all();
        $candidate = $request->user();

        if ($candidate->is_live) {
            return $this->redirectLiveCandidate($candidate);
        }

        if (!empty($input['refer'])) {
            $referrer = Candidate::whereEmail($input['refer'])->first();
            $candidate->referrer()->associate($referrer);
            $candidate->save();
            sendEmailReferralCandidate($candidate);
        }

        $candidate->is_live = true;
        $candidate->save();

        Log::info("Candidate: {$candidate->email} has gone live");

        sendEmailWelcomeCandidate($candidate);

        return redirect(route('candidate.dashboard'));
    }
}
