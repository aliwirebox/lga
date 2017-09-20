<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class HirerRegisterRequest extends Request
{
    protected $redirectRoute = 'hirer.register';

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name'  => 'required|max:255',
            'last_name'   => 'required|max:255',
            'email'       => 'required|email|max:255|unique:candidates,email|unique:hirers,email|unique:brand_admins,email',
            'telephone'   => 'required|phone:GB',
            'law_firm_id' => 'required_without:add_law_firm|integer|exists:law_firms,id',
            'password'    => 'required|min:6|max:255',
        ];
    }
}
