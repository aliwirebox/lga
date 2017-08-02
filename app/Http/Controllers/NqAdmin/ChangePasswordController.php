<?php

namespace App\Http\Controllers\NqAdmin;

use App\Http\Controllers\Traits\ChangePasswordTrait;

class ChangePasswordController extends BaseController
{
    use ChangePasswordTrait;
    
    protected $path = 'nq-admin.password.change';
    
    public function index()
    {
        $this->logInfo("views change password");

        return view('app.nq-admin.changepassword',['path' => $this->path]);
    }
}
