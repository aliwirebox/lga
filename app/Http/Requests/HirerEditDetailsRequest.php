<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class HirerEditDetailsRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:candidates,email|unique:hirers,email,' . getCurrentUser()->id . '|unique:brand_admins,email',
            'telephone' => 'required|phone:GB',
        ];
    }
}
