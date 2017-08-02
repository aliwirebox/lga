<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Traits\ChangePasswordTrait;

class ChangePasswordController extends BaseController
{
    use ChangePasswordTrait;
    
    protected $path = 'candidate.password.change';
            
    public function index()
    {
        $this->logInfo("views change password");
        
        return view('app.candidate.changepassword',['path' => $this->path]);
    }
}
