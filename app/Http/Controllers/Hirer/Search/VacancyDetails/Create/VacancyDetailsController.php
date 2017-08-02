<?php

namespace App\Http\Controllers\Hirer\Search\VacancyDetails\Create;

use App\Http\Controllers\Hirer\Search\VacancyDetails\BaseVacancyDetailsController;
use App\Http\Requests\HirerSearchVacancyDetailsRequest;

class VacancyDetailsController extends BaseVacancyDetailsController
{
    public function __construct()
    {
        parent::__construct();

        $this->submitUrl = route('hirer.search.vacancydetails');
    }

    public function store(HirerSearchVacancyDetailsRequest $request)
    {
        $request->session();
        $input = $request->all();

        $request->session()->put('search.location', $input['location']);
        $request->session()->put('search.salary', $input['salary']);
        $request->session()->put('search.departments', $input['departments']);

        if (isset($input['additional_information']) && !empty($input['additional_information'])) {
            $request->session()->put('search.additional_information', $input['additional_information']);
        }

        return redirect(route('hirer.search.candidatefilters'));
    }
}
