<?php

namespace App\Http\Controllers\Candidate\Account\Cv;

use App\Http\Controllers\Candidate\Account\BaseAccountController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BaseCvController extends BaseAccountController
{
    public $nextLink = '';

    public function index(Request $request)
    {
        if ($request->user()->cv_name) {
            $existingCv = [
                'name' => $request->user()->cv_name,
                'size' => $request->user()->cv_size
            ];
        } else {
            $existingCv = false;
        }

        return view('app.candidate.profile.cv', ['existingCv' => $existingCv, 'nextLink' => $this->nextLink]);
    }

    public function save($user, $cv)
    {
        $fileContents = file_get_contents($cv->getRealPath());

        Storage::disk('candidate-cvs')->put($user->id, $fileContents);

        $cvName = $cv->getClientOriginalName();
        $cvSize = $cv->getClientSize();

        $user->update([
                          'cv_name' => $cvName,
                          'cv_size' => $cvSize
                      ]);

        Log::info("Candidate: {$user->email} uploaded a cv called $cvName");
    }
}
