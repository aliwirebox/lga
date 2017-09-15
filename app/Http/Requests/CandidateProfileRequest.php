<?php

namespace App\Http\Requests;

use Carbon\Carbon;

class CandidateProfileRequest extends Request
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
        $degrees = getCsvConfigKeys('degree-class.candidate-options');       

        return [
            'has_degree'                    => ['required', 'boolean'],
            'degree_class'                  => ['required_if:has_degree,1', 'in:' . $degrees],
            'has_lpc'                       => ['required', 'boolean'],
            'has_rtw'                       => ['required', 'boolean'],
            'member_institute_paralegals'   => ['required', 'boolean'],
            'member_of_cilex'               => ['required', 'boolean'],
            'years_experience'              => ['required', 'integer'],
            'top_skills'                    => ['required', 'max:8'],
            'top_skills.*'                  => ['required', 'exists:training_seats,id'],
            'current_law_firm'              => ['required', 'exists:law_firms,id'],
            'languages.*'                   => ['required', 'exists:languages,id'],
        ];
    }

    public function messages()
    {
        return [
            'training_seats.max' => 'You may select a maximum of  8 skills.',
        ];
    }
}
