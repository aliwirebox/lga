<?php

namespace App\Http\Controllers\Candidate\Account;

use Illuminate\Http\Request;

class ViewProfileController extends BaseAccountController
{
    public function index(Request $request)
    {
        $user = $request->user();

        $blacklistedLawFirms = $user->blacklistedLawFirms;

        $degreeClassList = config('degree-class.candidate-options');

        return view('app.candidate.profile.index', ['user' => $user], compact('candidate', 'degreeClassList', 'blacklistedLawFirms'));
    }
}
