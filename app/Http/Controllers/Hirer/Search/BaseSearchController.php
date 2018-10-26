<?php

namespace App\Http\Controllers\Hirer\Search;

use App\Http\Controllers\Hirer\BaseController;
use App\Models\Language;
use App\Models\LawFirmBand;
use App\Models\Search;
use App\Models\TrainingSeat;
use App\Models\UniversityBand;

class BaseSearchController extends BaseController
{
    public $editing = false;
    public $submitUrl = '';

    public function __construct()
    {
        parent::__construct();

        view()->share('editing', $this->editing);
        view()->share('submitUrl', $this->submitUrl);

        $this->middleware('auth:hirers');
    }

    public function createSearch($session)
    {
        $hirer = getCurrentUser();
 
        $data = [
            'name'                        => '',
            'available_date'              => $session['available_date'],
            'travel_abroad'               => $session['travel_abroad'],
            'position_permanent'          => $session['position_permanent'],
            'has_degree'                  => $session['has_degree'],
            'has_lpc'                     => $session['has_lpc'],
            'years_experience'            => $session['years_experience'],
            'member_institute_paralegals' => $session['member_institute_paralegals'],
            'member_of_cilex'             => $session['member_of_cilex'],
            'vacancy_salary'              => $session['salary'],
            'hirer_id'                    => $hirer->id,
            'vacancy_department_id'       => $session['departments'],
            'vacancy_location_id'         => $session['location'],
            'role_id'                     => $session['role_id'],
        ];

        if (isset($session['additional_information']) && !empty($session['additional_information'])) {
            $data['vacancy_additional_information'] = $session['additional_information'];
        }

        $search = Search::create($data);

        if (isset($session['training_seats']) && count($session['training_seats']) > 0) {
            $search->trainingSeats()->sync($session['training_seats']);
        }

        if (isset($session['languages']) && count($session['languages']) > 0) {
            $search->languages()->sync($session['languages']);
        }

//        if (isset($session['training_law_firm_bands']) && count($session['training_law_firm_bands']) > 0) {
//            $trainingLawFirmBandsId = checkFirm($session['training_law_firm_bands']);
//
//            $search->trainingLawFirmBands()->sync($trainingLawFirmBandsId);
//        }
//
        $search->updateMatches();

        $search->save();

        return $search;
    }
}
