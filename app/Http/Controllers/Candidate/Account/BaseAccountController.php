<?php

namespace App\Http\Controllers\Candidate\Account;

use App\Http\Controllers\Candidate\BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class BaseAccountController extends BaseController
{
    public $editing = false;
    public $submitUrl = '';
    public $previousUrl = '';

    public function __construct()
    {
        parent::__construct();

        view()->share('editing', $this->editing);
        view()->share('submitUrl', $this->submitUrl);
        view()->share('previousUrl', $this->previousUrl);
    }
}