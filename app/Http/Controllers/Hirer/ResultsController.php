<?php

namespace App\Http\Controllers\Hirer;

use App\Http\Requests\HirerRequestCvRequest;
use App\Http\Requests\HirerViewedMatchRequest;
use App\Models\Candidate;
use App\Models\HirerMatchQuery;
use App\Models\Search;
use Illuminate\Support\Facades\Log;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Mail;

class ResultsController extends BaseController
{
    public function index(Search $search)
    {
        $this->authorize('view-update-search', $search);

        $matchesRoute = route('hirer.search.results.data', $search->id);
        $requestCvRoute = route('hirer.search.results.request', $search->id);
        $viewedMatchRoute = route('hirer.search.results.viewed', $search->id);

        $this->logInfo("views search results for {$search->id}");

        return view('app.hirer.search.results', compact('search', 'matchesRoute', 'requestCvRoute', 'viewedMatchRoute'));
    }

    public function anyData(Search $search)
    {
        $this->authorize('view-update-search', $search);

        $matches = HirerMatchQuery::getAllMatchesBySearch($search->id)
            ->get()
            ->map('transformHirerMatchForDatatable');

        $this->logInfo("requests {$matches->count()} match records for search {$search->id}");

        return Datatables::of($matches)->make(true);
    }

    public function update(HirerRequestCvRequest $request, Search $search)
    {
        $this->authorize('view-update-search', $search);

        foreach ($request->candidate_id_list as $id) {
            if (!$search->uncontactedMatches->contains($id)) {
                $this->logInfo("is blocked from requesting the cv of candidate {$id}");
                abort(401);
            }
        }

        foreach ($request->candidate_id_list as $id) {
            $candidate = Candidate::findOrFail($id);
            $search->matches()->updateExistingPivot($candidate->id, [
                'status' => config('match.cv-request'),
                'hirer_viewed' => true
            ]);
            sendEmailCvRequested($search, $candidate);
            $this->logInfo("requests cv for {$candidate->email}");
        }

        return response()->json(['status' => 'OK']);
    }

    protected function viewed(HirerViewedMatchRequest $request, Search $search)
    {
        $this->authorize('view-update-search', $search);

        foreach ($request->candidate_id_list as $id) {
            $candidate = Candidate::findOrFail($id);
            $search->matches()->updateExistingPivot($candidate->id, ['hirer_viewed' => true]);
            $this->logInfo("views {$candidate->email} profile");
        }
    }
}
