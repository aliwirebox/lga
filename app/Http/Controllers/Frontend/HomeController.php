<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller as DefaultController;

class HomeController extends DefaultController
{
    public function index()
    {
        return view('frontend.home.index');
    }
}

