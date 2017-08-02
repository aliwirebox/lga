<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CandidateDetailsRequest extends Request
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
            'email' => 'required|email|max:255|unique:candidates,email,' . $this->user()->id . '|unique:hirers,email|unique:nq_admins,email',
            'telephone' => 'required|phone:GB',
        ];
    }
}
