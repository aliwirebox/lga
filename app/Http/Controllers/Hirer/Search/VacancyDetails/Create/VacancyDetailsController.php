<?php

namespace App\Http\Controllers\Hirer\Search\VacancyDetails\Create;

use App\Http\Controllers\Hirer\Search\VacancyDetails\BaseVacancyDetailsController;
use App\Http\Requests\HirerSearchVacancyDetailsRequest;
use Carbon\Carbon;

class VacancyDetailsController extends BaseVacancyDetailsController
{
    public function __construct()
    {
        parent::__construct();

        $this->submitUrl = route('hirer.search.vacancydetails');
    }

    public function store(HirerSearchVacancyDetailsRequest $request)
    {
        $this->updateHirerTerms($request);
        $request->session();
        $input = $request->all();
        $defaultAvailableDate = Carbon::now()->toDateString();

        $request->session()->put('search.location', $input['location']);
        $request->session()->put('search.available_date', castTextInput($request, 'available_date', $defaultAvailableDate));
        $request->session()->put('search.travel_abroad', $request->input('travel_abroad', 0));
        $request->session()->put('search.position_permanent', $request->input('position_permanent', 0));
        $request->session()->put('search.salary', $input['salary']);
        $request->session()->put('search.departments', $input['departments']);

        if (isset($input['additional_information']) && !empty($input['additional_information'])) {
            $request->session()->put('search.additional_information', $input['additional_information']);
        }

        return redirect(route('hirer.search.search-results'));
    }
}
