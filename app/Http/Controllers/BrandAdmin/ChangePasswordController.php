<?php

namespace App\Http\Controllers\BrandAdmin;

use App\Http\Controllers\Traits\ChangePasswordTrait;

class ChangePasswordController extends BaseController
{
    use ChangePasswordTrait;
    
    protected $path = 'brand-admin.password.change';
    
    public function index()
    {
        $this->logInfo("views change password");

        return view('app.brand-admin.changepassword',['path' => $this->path]);
    }
}
