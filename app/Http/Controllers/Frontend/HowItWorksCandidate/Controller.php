<?php
namespace App\Http\Controllers\Frontend\HowItWorksCandidate;

use App\Http\Controllers\Controller as DefaultController;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

use App\Http\Requests\RegisterRequest;

use Log;

class Controller extends DefaultController
{
    public function index()
    {
        return view('frontend.how-it-works-candidate.index');
    }

    /**
     * 
     * @param \Illuminate\Http\Request $request
     * @return type
     */
}
