<?php

namespace App\Http\Requests;

use Illuminate\Routing\Route;


class CandidateRegisterRequest extends Request
{
    protected $redirectRoute = 'candidate.register';

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:candidates,email|unique:hirers,email|unique:nq_admins,email',
            'password' => 'required|min:6|max:255',
        ];
    }
}
