<?php

namespace App\Http\Controllers\Candidate\Account\Profile;

use App\Http\Controllers\Candidate\Account\BaseAccountController;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class BaseProfileController extends BaseAccountController
{
    protected $isEmployedByTraingFirm = 'Yes';

    public function index(Request $request)
    {
        $candidate = $request->user();

        $degreeClassList = config('degree-class.candidate-options');

        if ($candidate->trainingLawFirm && !$candidate->isEmployedByTrainingFirm() && $candidate->currentLawFirm) {
            $isEmployedByTraingFirm = 'No';
        } elseif ($candidate->trainingLawFirm && !$candidate->isEmployedByTrainingFirm() && !$candidate->currentLawFirm) {
            $isEmployedByTraingFirm = 'Not Working';
        } else {
            $isEmployedByTraingFirm = 'Yes';
        }

        return view('app.candidate.profile.your-profile', compact('candidate', 'degreeClassList', 'isEmployedByTraingFirm'));
    }

    public function save($user, $input)
    {
        $user->update([
            'ucas_points'                       => $input['ucas_points'],
            'degree_class'                      => $input['degree_class'],
            'taken_client_secondment'           => $input['client_secondment'],
            'employed_by_training_firm'         => $input['employed_by_training_firm'],
            'date_qualified'                    => $input['qualified_date'],
            'did_training_firm_offer_position'  => $input['training_firm_position_offered'],
            'has_degree'                        => isset($input['has_degree']),
            'has_lpc'                           => isset($input['has_lpc']),
            'has_rtw'                           => isset($input['has_rtw']),
            'member_institute_paralegals'       => isset($input['member_institute_paralegals']),
            'member_of_cilex'                   => isset($input['member_of_cilex']),
        ]);       

        $user->university()->associate($input['university']);
        $user->trainingLawFirm()->associate($input['training_law_firm']);


        if ($input['employed_by_training_firm'] == 'No') {
            $user->currentLawFirm()->associate($input['current_law_firm']);
        } elseif ($input['employed_by_training_firm'] == 'Yes') {
            $user->currentLawFirm()->associate($input['training_law_firm']);
        } else {
            $user->currentLawFirm()->dissociate();
        }

        if (isset($input['training_seats'])) {
            $user->trainingSeats()->sync($input['training_seats']);
        } else {
            $user->trainingSeats()->sync([]);
        }

        if (isset($input['languages'])) {
            $user->languages()->sync($input['languages']);
        } else {
            $user->languages()->sync([]);
        }

        $user->save();

        Log::info("Candidate: {$user->email} updated their profile details");
    }
}
