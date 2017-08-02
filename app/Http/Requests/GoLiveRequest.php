<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class GoLiveRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $currentUserId = $this->user()->id;


        return [
            'terms' => ['required', 'accepted'],
            'refer' => ['email', 'exists:candidates,email,id,!' . $currentUserId]
        ];
    }

    public function messages()
    {
        return [
            'refer.exists' => 'We do not recognise the e-mail address that you have provided in the Candidate Referral section. Please enter the e-mail address that your Referee used to register with NQSolicitors.com.'
        ];
    }
}
