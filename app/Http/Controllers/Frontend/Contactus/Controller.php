<?php
namespace App\Http\Controllers\Frontend\Contactus;

use App\Http\Controllers\Controller as DefaultController;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

use App\Http\Requests\ContactUsRequest;

use Log;

class Controller extends DefaultController
{
    public function index()
    {
        return view('frontend.contact-us.index');
    }

    /**
     * 
     * @param \Illuminate\Http\Request $request
     * @return type
     */
    public function post(ContactUsRequest $request)
    {
        $input = $request->all();
        $token = $request->input('g-recaptcha-response');


        
        
        
        if ($token) {
            sendEmailContactUs($input);
        return View::make('frontend.contact-us.confirm');

    }else {
        return view('frontend.contact-us.index');
    }
    }
    public function schedule()
    {
        return View::make('frontend.schedule-meeting.index');
    }
}
