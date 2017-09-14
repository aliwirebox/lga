<?php

namespace App\Http\Controllers\Hirer\Search\CandidateFilters\Create;

use App\Http\Controllers\Hirer\Search\CandidateFilters\BaseCandidateFiltersController;
use App\Http\Requests\HirerSearchCandidateFiltersCreateRequest;
use Carbon\Carbon;

class CandidateFiltersController extends BaseCandidateFiltersController
{
    public $editing = false;

    public function __construct()
    {
        parent::__construct();

        $this->submitUrl = route('hirer.search.candidatefilters');
    }

    public function store(HirerSearchCandidateFiltersCreateRequest $request)
    {

        $session = $request->session();

        $session->put('search.has_degree', $request->input('has_degree', 0));
        $session->put('search.has_lpc', $request->input('has_lpc', 0));
        $session->put('search.member_institute_paralegals', $request->input('member_institute_paralegals', 0));
        $session->put('search.member_of_cilex', $request->input('member_of_cilex', 0));
        $session->put('search.years_experience', $request->input('years_experience', 0));
        $session->put('search.training_seats', $request->input('training_seats'));

//        $session->put('search.training_law_firm_bands', castTextInput($request, 'training_law_firm_bands', [1]));
//        $session->put('search.languages', $request->input('languages'));
        return redirect(route('hirer.search.vacancydetails'));
    }
}
