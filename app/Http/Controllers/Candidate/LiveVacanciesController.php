<?php

namespace App\Http\Controllers\Candidate;

use App\Models\CandidateMatchQuery;
use Yajra\DataTables\Facades\DataTables;

class LiveVacanciesController extends BaseController
{
    public function index()
    {
        $this->logInfo("views live vacancies");

        return view('app.candidate.live-vacancies');
    }

    public function anyData()
    {
        $candidate = getCurrentUser();

        $vacancyList = CandidateMatchQuery::getLiveMatchesByCandidate($candidate->id)
            ->get()
            ->map('transformCandidateMatchForDatatable');

        $this->logInfo("requests {$vacancyList->count()} live vacancy records");
        
        return Datatables::of($vacancyList)->make(true);
    }
}
