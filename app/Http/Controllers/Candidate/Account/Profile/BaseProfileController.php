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
            'has_degree'                    => $input['has_degree'],
            'degree_class'                  => $input['has_degree'] ? $input['degree_class'] : 0,
            'has_lpc'                       => $input['has_lpc'],
            'has_rtw'                       => $input['has_rtw'],
            'member_institute_paralegals'   => $input['member_institute_paralegals'],
            'member_of_cilex'               => $input['member_of_cilex'],
            'years_experience'              => $input['years_experience'],
        ]);

        $user->currentLawFirm()->associate($input['current_law_firm']);

        if (isset($input['top_skills'])) {
            $user->trainingSeats()->sync($input['top_skills']);
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
