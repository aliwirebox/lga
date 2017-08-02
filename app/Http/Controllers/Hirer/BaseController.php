<?php

namespace App\Http\Controllers\Hirer;

use App\Http\Controllers\Controller;
use Log;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:hirers');
    }

    protected function logInfo($message)
    {
        $hirer = getCurrentUser();

        Log::info("Hirer {$hirer->email} " . $message);
    }
}
