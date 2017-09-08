<?php

namespace App\Http\Controllers\BrandAdmin;

use App\Http\Controllers\Controller;
use Log;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:brand_admins');
    }

    protected function logInfo($message)
    {
        $admin = getCurrentUser();

        Log::info("Admin {$admin->email} " . $message);
    }
}
