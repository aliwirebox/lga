<?php

namespace App\Http\Controllers\Hirer\Search\CandidateFilters\Update;

use App\Http\Controllers\Hirer\Search\CandidateFilters\BaseCandidateFiltersController;
use App\Http\Requests\HirerSearchCandidateFiltersUpdateRequest;
use App\Models\LawFirmBand;
use App\Models\Search;

class CandidateFiltersController extends BaseCandidateFiltersController
{
    public $editing = true;

    public function show($id)
    {
        $search = Search::findOrFail($id);

        $this->authorize('view-update-search', $search);

        $hirer = getCurrentUser();
        $bands = LawFirmBand::getParents()->get();
        $typeOfFirmOptionList = getTypeOfFirmOptionList($bands);
        $typeOfFirmOptionList = $typeOfFirmOptionList['genericBands'];

        $degreeClassList = config('degree-class.search-options');

        $submitUrl = route('hirer.search.candidatefilters.edit', $search->id);

        return view('app.hirer.search.candidatefilters', compact('degreeClassList', 'typeOfFirmOptionList', 'search', 'submitUrl', 'hirer'));
    }

    public function store(HirerSearchCandidateFiltersUpdateRequest $request, $id)
    {
        $search = Search::findOrFail($id);

        $this->authorize('view-update-search', $search);

        $search->min_ucas_points = castTextInput($request, 'ucas_points', 0);
        $search->min_degree_class = $request->input('degree_class', 0);
        $search->taken_client_secondment = castTextInput($request, 'client_secondment');
        $search->date_qualified_from = castTextInput($request, 'qualified_date_from');
        $search->date_qualified_to = castTextInput($request, 'qualified_date_to');
        $search->universityBands()->sync(castTextInput($request, 'universities', [1]));
        $search->trainingSeats()->sync(castTextInput($request, 'training_seats', []));
        $search->languages()->sync(castTextInput($request, 'languages', []));
        $search->has_degree = $request->input('has_degree', 0);
        $search->has_lpc = $request->input('has_lpc', 0);
        $search->member_institute_paralegals = $request->input('member_institute_paralegals', 0);
        $search->member_of_cilex = $request->input('member_of_cilex', 0);
        $search->years_experience = $request->input('years_experience', 0);

        if (!empty($request->input('training_law_firm_bands'))) {
            $search->trainingLawFirmBands()->sync(checkFirm($request->input('training_law_firm_bands')));
        } else {
            $search->trainingLawFirmBands()->sync([1]);
        }

        $search->updateMatches();

        $search->save();

        return redirect(route('hirer.search.vacancydetails.edit', $search->id));
    }
}
