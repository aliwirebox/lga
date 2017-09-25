<?php

namespace App\Http\Controllers\Candidate;

class RequestDeleteController extends BaseController
{
    public function store()
    {
        $candidate = getCurrentUser();

        $this->logInfo("requests their account should be deleted");

        sendEmailCandidateDeleteRequest($candidate);

        return response()->json(['message' => 'OK']);
    }
}
