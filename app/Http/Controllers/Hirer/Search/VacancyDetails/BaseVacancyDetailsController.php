<?php

namespace App\Http\Controllers\Hirer\Search\VacancyDetails;

use App\Http\Controllers\Hirer\Search\BaseSearchController;
use App\Models\Search;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Log;
use App\Http\Requests\HirerSearchVacancyDetailsRequest;

class BaseVacancyDetailsController extends BaseSearchController
{
    public function index(Request $request)
    {
        $currentSearch = $request->session()->get('search');

        if (!$currentSearch) {
            Log::warning('Search filters page accessed with no session set');
            return redirect()->route('hirer.search.candidatefilters');
        }
        $salaries = config('salary-map.vacancy-options');
        $search = new Search();
        $hirer = getCurrentUser();

        return view('app.hirer.search.vacancydetails', compact('salaries', 'search', 'hirer'));
    }
    protected function updateHirerTerms(HirerSearchVacancyDetailsRequest $request)
    {
        if ($request->input('agreed_terms')) {
            $hirer = getCurrentUser();
            $hirer->agreed_terms = true;
            $hirer->save();
        }
    }
}
