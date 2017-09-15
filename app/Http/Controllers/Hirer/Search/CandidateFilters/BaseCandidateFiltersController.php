<?php

namespace App\Http\Controllers\Hirer\Search\CandidateFilters;

use App\Http\Controllers\Hirer\Search\BaseSearchController;
use App\Http\Requests\HirerSearchCandidateFiltersRequest;
use App\Models\LawFirmBand;
use App\Models\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BaseCandidateFiltersController extends BaseSearchController
{
    public function index(Request $request)
    {

        $hirer = getCurrentUser();
        $bands = LawFirmBand::with('children')
            ->getParents()
            ->get();

        $typeOfFirmOptionList = getTypeOfFirmOptionList($bands);
        $typeOfFirmOptionList = $typeOfFirmOptionList['genericBands'];

        $degreeClassList = config('degree-class.search-options');

        $search = new Search();
        $search->min_ucas_points = null; //so placeholder text shows
        $search->min_degree_class = null; //so placeholder text shows

        return view('app.hirer.search.candidatefilters', compact('degreeClassList', 'typeOfFirmOptionList', 'search', 'hirer'));
    }

}
