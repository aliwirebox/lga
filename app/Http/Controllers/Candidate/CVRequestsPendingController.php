<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Requests\CandidateCvRequestResponseRequest;
use App\Models\CandidateMatchQuery;
use App\Models\Search;
use Yajra\DataTables\Facades\DataTables;
use Log;
use Mail;

class CVRequestsPendingController extends BaseController
{
    public function index()
    {
        $this->logInfo("views CV requests pending");

        return view('app.candidate.cv-requests-pending');
    }

    public function anyData()
    {
        $candidate = getCurrentUser();

        $candidate->setCvRequestMatchesAsViewed();

        $cvRequestPendingList = CandidateMatchQuery::getCvRequestedMatchesByCandidate($candidate->id)
            ->get()
            ->map('transformCandidateMatchForDatatable');

        $this->logInfo("requests {$cvRequestPendingList->count()} CV requests records");
        
        return Datatables::of($cvRequestPendingList)->make(true);
    }

    public function update(CandidateCvRequestResponseRequest $request, $id)
    {
        $this->updateCvRequest($request, $id);

        return response()->json(['status' => 'OK']);
    }

    public function email(CandidateCvRequestResponseRequest $request, $id)
    {
        $this->updateCvRequest($request, $id);

        $message = $request->input('status') == config('match.cv-pending') ? 'CV released' : 'Request declined';

        session()->flash('message', $message);

        return redirect()->route('candidate.live-vacancies');
    }

    protected function updateCvRequest(CandidateCvRequestResponseRequest $request, $id)
    {
        $candidate = getCurrentUser();
        $search = Search::findOrFail($id);

        if (!$search->cvRequestedMatches->contains($candidate->id)) {
            $this->logInfo("{$candidate->email} tires to update search {$search->id} but they aren't listed as a requested cv");
            abort(401);
        }

        $search->matches()->updateExistingPivot($candidate->id, $request->only('status'));

        $this->logInfo("updates {$candidate->email} to status {$request->input('status')} for search {$search->id}");

        sendEmailByMatchStatus($request->input('status'), $search, $candidate);
    }
}
