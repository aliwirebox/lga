<?php

namespace App\Http\Controllers\Hirer;

use App\Http\Controllers\Traits\ChangePasswordTrait;

class ChangePasswordController extends BaseController
{
    use ChangePasswordTrait;
    
    protected $path = 'hirer.password.change';
    
    public function index()
    {
        $this->logInfo("views change password");

        return view('app.hirer.changepassword',['path' => $this->path]);
    }
}
