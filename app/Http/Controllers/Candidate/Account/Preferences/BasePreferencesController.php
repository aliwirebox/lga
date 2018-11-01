<?php

namespace App\Http\Controllers\Candidate\Account\Preferences;

use App\Http\Controllers\Candidate\Account\BaseAccountController;
use App\Http\Requests\TypeOfFirmOptionRequest;
use App\Models\LawFirmBand;
use App\Models\Location;
use App\Models\Role;
use App\Models\TrainingSeat;
use Illuminate\Support\Facades\Log;

class BasePreferencesController extends BaseAccountController
{
    public function index()
    {
        $candidate = getCurrentUser();
        $salaries = config('salary-map.candidate-options');
        $locations = Location::with('ancestors')->withDepth()->get()->toTree();
        $roles = Role::orderBy('name', 'desc')->get();
        $selectedDepartments = $candidate->preferedDepartments->lists('id')->toArray();
        $blacklistedLawFirms = $candidate->blacklistedLawFirms->lists('id')->toArray();
        $selectedLocations = $candidate->preferedLocations->lists('id')->toArray();
        $deptSel1 = TrainingSeat::department()->whereIn('id', [1, 2])->get();
        $deptSel2 = TrainingSeat::department()->whereNotIn('id', [1, 2])->orderBy('name')->get();
        $trainingSeats = $deptSel1->merge($deptSel2);

        $viewData = compact(
            'roles',
            'locations',
            'salaries',
            'candidate',
            'selectedDepartments',
            'selectedLawFirmBands',
            'selectedLocations',
            'blacklistedLawFirms',
            'trainingSeats'
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
            'role_id'           => $input['role_id'],
            'minimum_salary'    => $input['minimum_salary'],
            'travel_abroad'     => $input['travel_abroad'],
            'available_date'    => $input['available_date'],
            'seeking_permanent' => isset($input['seeking_permanent']),
            'seeking_contract'  => isset($input['seeking_contract']),
        ]);

        $user->preferedLocations()->sync($input['locations']);
        $user->preferedDepartments()->sync($input['departments']);

        if (!isset($input['law_firm_blacklist'])) {
            $input['law_firm_blacklist'] = [];
        }
    
        $user->blacklistedLawFirms()->sync(checkFirm($input['law_firm_blacklist']));

        Log::info("Candidate: {$user->email} updated their preferences");
    }
}
