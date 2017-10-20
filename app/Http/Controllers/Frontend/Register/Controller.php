<?php
namespace App\Http\Controllers\Frontend\Register;

use App\Http\Controllers\Controller as DefaultController;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Hirer;

use App\Http\Requests\RegisterRequest;

use Log;

class Controller extends DefaultController
{
    public function index($type = 'candidate')
    {
        if($type = 'employer'){
            $type = 'hirer';
        }
        $model = 'App\\Models\\' . ucfirst($type);
        $user = new $model();
        if(session('socialUser')){
            $user->fill(session('socialUser'));
        }

        return view('frontend.register.index')->with(['type' => $type, 'user' => $user]);
    }

    /**
     * 
     * @param \Illuminate\Http\Request $request
     * @return type
     */
}
