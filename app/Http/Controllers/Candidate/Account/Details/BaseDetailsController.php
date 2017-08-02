<?php

namespace App\Http\Controllers\Candidate\Account\Details;

use App\Http\Controllers\Candidate\Account\BaseAccountController;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class BaseDetailsController extends BaseAccountController
{
    public function index(Request $request)
    {
        return view('app.candidate.profile.details', ['candidate' => $request->user()]);
    }

    public function save($user, $input)
    {
        $user->update($input);

        Log::info("Candidate: {$user->email} updated their profile details");
    }
}