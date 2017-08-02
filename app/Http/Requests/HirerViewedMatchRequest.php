<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class HirerViewedMatchRequest extends Request
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
