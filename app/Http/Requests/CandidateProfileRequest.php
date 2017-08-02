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
        $user = getCurrentUser();
        $after = $user->created_at->startOfMonth()->subMonths(24);
        $before = $user->created_at->startOfMonth()->addMonths(24);
        /*
         * The before and after date is based off the time the user is created
         * rather than "now", because "now" will keep moving the valid window of time
         * which might make a valid quilfication date invalid when a user edits their
         * profile.
         */

        return [
            'ucas_points'                    => ['required', 'integer' , 'digits_between:1,3'],
            'university'                     => ['required', 'exists:universities,id'],
            'degree_class'                   => ['required', 'in:' . $degrees],
            'training_law_firm'              => ['required', 'exists:law_firms,id'],
            'client_secondment'              => ['required', 'boolean'],
            'training_seats'                 => ['required', 'max:8'],
            'training_seats.*'               => ['required', 'exists:training_seats,id'],
            'qualified_date'                 => ['required', 'date', 'before_equal:' . $before->toDateString(), 'after_equal:' . $after->toDateString()],
            'languages.*'                    => ['required', 'exists:languages,id'],
            'employed_by_training_firm'      => ['required'],
            'current_law_firm'               => ['required_if:employed_by_training_firm,No', 'exists:law_firms,id'],
            'training_firm_position_offered' => ['required', 'integer', 'between:0,2'],
        ];
    }

    public function messages()
    {
        return [
            'training_seats.max' => 'You may select a maximum of  8 training seats.',
            'ucas_points.digits_between' => 'The ucas points must be a maximum of 3 characters/figures.'
        ];
    }
}
