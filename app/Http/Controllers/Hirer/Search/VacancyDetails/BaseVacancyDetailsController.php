<?php

namespace App\Http\Controllers\Hirer\Search\VacancyDetails;

use App\Http\Controllers\Hirer\Search\BaseSearchController;
use App\Http\Requests\HirerSearchVacancyDetailsRequest;
use App\Models\Location;
use App\Models\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Log;

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
        $locations = Location::with('ancestors')->withDepth()->get()->toTree();

        return view('app.hirer.search.vacancydetails', compact('salaries', 'search', 'hirer', 'locations'));
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
