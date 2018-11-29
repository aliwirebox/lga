<?php
namespace App\Http\Controllers\Frontend\Pricing;

use App\Http\Controllers\Controller as DefaultController;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;





use Log;

class Controller extends DefaultController
{
    public function index()
    {
        return view('frontend.pricing.index');
       
        
    }

    /**
     * 
     * @param \Illuminate\Http\Request $request
     * @return type
     */
}
