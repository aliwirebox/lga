<?php

namespace App\Http\Controllers\Candidate\Account\Preferences;

use App\Http\Controllers\Candidate\Account\BaseAccountController;
use App\Http\Requests\TypeOfFirmOptionRequest;
use App\Models\LawFirmBand;
use App\Models\Location;
use Illuminate\Support\Facades\Log;

class BasePreferencesController extends BaseAccountController
{
    public function index()
    {
        $candidate = getCurrentUser();
        $salaries = config('salary-map.candidate-options');
        $locations = Location::all();
        $selectedDepartments = $candidate->preferedDepartments->lists('id')->toArray();
        $selectedLocations = $candidate->preferedLocations->lists('id')->toArray();

        $viewData = compact(
            'locations',
            'salaries',
            'candidate',
            'selectedDepartments',
            'selectedLawFirmBands',
            'selectedLocations'
        );

        Log::info("Candidate: {$candidate->email} views the preferences form");

        return view('app.candidate.profile.preferences', $viewData);
    }

    public function typeOfFirmOptionData(TypeOfFirmOptionRequest $request)
    {
        $locations = $request->input('locations', []);
        
        if (!$locations) {
            return ''; //return 0 options, to hide the select
        }

        $candidate = getCurrentUser();

        $bands = LawFirmBand::with('children')
            ->whereAnyRelationIds('locations', $locations)
            ->getParents()
            ->get();

        $selectedLawFirmBands = $candidate->preferedLawFirmBands->lists('id')->toArray();
        $typeOfFirmOptionList = getTypeOfFirmOptionList($bands);

        return view('app.candidate.partials.type-of-firm-select-options', compact('typeOfFirmOptionList', 'selectedLawFirmBands'));
    }

    public function save($user, $input)
    {
        $user->update([
            'minimum_salary' => $input['minimum_salary'],
        ]);

        $user->preferedLocations()->sync($input['locations']);
        $user->preferedDepartments()->sync($input['departments']);
        $user->preferedLawFirmBands()->sync(checkFirm($input['type_of_firms']));

        Log::info("Candidate: {$user->email} updated their preferences");
    }
}
