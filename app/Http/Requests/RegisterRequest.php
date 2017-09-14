<?php

namespace App\Http\Requests;

class RegisterRequest extends Request
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
            'email' => 'required|email|max:255',
            'email_body' => 'required',
        ];
    }
}
