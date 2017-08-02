<?php

namespace App\Http\Controllers\Hirer\Search\VacancyDetails;

use App\Http\Controllers\Hirer\Search\BaseSearchController;
use App\Models\Search;
use Illuminate\Support\Facades\Session;

class BaseVacancyDetailsController extends BaseSearchController
{
    public function index()
    {
        $salaries = config('salary-map.vacancy-options');
        $search = new Search();

        return view('app.hirer.search.vacancydetails', compact('salaries', 'search'));
    }
}
