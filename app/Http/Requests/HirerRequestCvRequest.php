<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class HirerRequestCvRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'candidate_id_list' => 'required|array'
        ];
    }
}
