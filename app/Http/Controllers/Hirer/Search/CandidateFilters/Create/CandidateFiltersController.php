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
        $this->updateHirerTerms($request);

        $defaultDateFrom = Carbon::now()->startOfMonth()->subMonths(18)->toDateString();
        $defaultDateTo = Carbon::now()->startOfMonth()->addMonths(24)->toDateString();

        $session = $request->session();

        $session->put('search.ucas_points', castTextInput($request, 'ucas_points', 0));
        $session->put('search.degree_class', $request->input('degree_class', 0));
        $session->put('search.client_secondment', castTextInput($request, 'client_secondment'));
        $session->put('search.qualified_date_from', castTextInput($request, 'qualified_date_from', $defaultDateFrom));
        $session->put('search.qualified_date_to', castTextInput($request, 'qualified_date_to', $defaultDateTo));
        $session->put('search.universities', castTextInput($request, 'universities', [1]));
        $session->put('search.training_law_firm_bands', castTextInput($request, 'training_law_firm_bands', [1]));
        $session->put('search.training_seats', $request->input('training_seats'));
        $session->put('search.languages', $request->input('languages'));

        return redirect(route('hirer.search.search-results'));
    }
}
