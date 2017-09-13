<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Candidate\BaseController;

use App\Models\CandidateMatchQuery;
use Datatables;

class DashboardController extends BaseController
{
    public function index()
    {
        $candidate = getCurrentUser();

        $preferedLawFirmBandList = $candidate->preferedLawFirmBands()->childless()->get();
        $blacklistedLawFirms = $candidate->blacklistedLawFirms->lists('id')->toArray();

        $liveVacancyList = CandidateMatchQuery::getLiveMatchesByCandidate($candidate->id)
            ->take(5)
            ->get()
            ->map('transformCandidateMatchForDatatable');

        $cvPendingList = CandidateMatchQuery::getCvRequestedMatchesByCandidate($candidate->id)
            ->take(3)
            ->get()
            ->map('transformCandidateMatchForDatatable');

        $this->logInfo("views dashboard");

        return view('app.candidate.dashboard.index', compact('candidate', 'liveVacancyList', 'cvPendingList', 'preferedLawFirmBandList','blacklistedLawFirms'));
    }
}
