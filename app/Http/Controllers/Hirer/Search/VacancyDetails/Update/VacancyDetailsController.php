<?php

namespace App\Http\Controllers\Hirer\Search\VacancyDetails\Update;

use App\Http\Controllers\Hirer\Search\VacancyDetails\BaseVacancyDetailsController;
use App\Http\Requests\HirerSearchVacancyDetailsRequest;
use App\Models\Location;
use App\Models\Search;

class VacancyDetailsController extends BaseVacancyDetailsController
{
    public $editing = true;

    public function show($id)
    {
        $search = Search::findOrFail($id);
        $salaries = config('salary-map.vacancy-options');
        $submitUrl = route('hirer.search.vacancydetails.edit', $search->id);
        $hirer = getCurrentUser();
        $locations = Location::withDepth()->get()->toTree();

        $this->authorize('view-update-search', $search);

        return view('app.hirer.search.vacancydetails', compact('salaries', 'search', 'submitUrl', 'hirer', 'locations'));
    }

    public function store(HirerSearchVacancyDetailsRequest $request, $id)
    {
        $this->updateHirerTerms($request);

        $search = Search::findOrFail($id);

        $this->authorize('view-update-search', $search);

        $input = $request->all();

        $search->available_date = $input['available_date'];
        $search->travel_abroad = $input['travel_abroad'];
        $search->position_permanent = $input['position_permanent'];
        $search->vacancy_location_id = $input['location'];
        $search->vacancy_salary = $input['salary'];
        $search->vacancy_department_id = $input['departments'];

        if (isset($input['additional_information']) && !empty($input['additional_information'])) {
            $search->vacancy_additional_information = $input['additional_information'];
        } else {
            $search->vacancy_additional_information = '';
        }

        $search->updateMatches();

        $search->save();

        return redirect(route('hirer.search.results', $search->id));
    }
}
