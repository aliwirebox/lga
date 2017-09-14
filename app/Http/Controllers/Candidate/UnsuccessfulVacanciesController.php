<?php

namespace App\Http\Controllers\Candidate;

use App\Models\CandidateMatchQuery;
use Yajra\Datatables\Datatables;

class UnsuccessfulVacanciesController extends BaseController
{
    public function index()
    {
        $this->logInfo("views unsuccessful vacancies");

        return view('app.candidate.unsuccessful-vacancies');
    }

    public function anyData()
    {
        $candidate = getCurrentUser();

        $vacancyList = CandidateMatchQuery::getUnsuccessfulMatchesByCandidate($candidate->id)
            ->get()
            ->map('transformCandidateMatchForDatatable');

        $this->logInfo("requests {$vacancyList->count()} unsuccessful vacancy records");
        
        return Datatables::of($vacancyList)->make(true);
    }
}
