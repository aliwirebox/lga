<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Candidate\BaseController;

use App\Models\CandidateMatchQuery;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends BaseController
{
    public function index()
    {
        $candidate = getCurrentUser();

        $blacklistedLawFirms = $candidate->blacklistedLawFirms;

        $liveVacancyList = CandidateMatchQuery::getLiveMatchesByCandidate($candidate->id)
            ->take(5)
            ->get()
            ->map('transformCandidateMatchForDatatable');

        $cvPendingList = CandidateMatchQuery::getCvRequestedMatchesByCandidate($candidate->id)
            ->take(3)
            ->get()
            ->map('transformCandidateMatchForDatatable');

        $this->logInfo("views dashboard");

        return view('app.candidate.dashboard.index', compact('candidate', 'liveVacancyList', 'cvPendingList', 'blacklistedLawFirms'));
    }
}
