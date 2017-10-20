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
        
        sendEmailContactUs($input);
        
        return View::make('frontend.contact-us.confirm');
    }
    public function schedule()
    {
        return View::make('frontend.schedule-meeting.index');
    }
}
