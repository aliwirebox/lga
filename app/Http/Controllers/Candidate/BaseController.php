<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Log;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:candidates');
    }

    protected function logInfo($message)
    {
        $candidate = getCurrentUser();

        Log::info("Candidate {$candidate->email} " . $message);
    }
}