<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TypeOfFirmOptionRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'locations.*' => ['required', 'exists:locations,id'],
        ];
    }
}
