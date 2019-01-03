<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Carbon\Carbon;

class CandidatePreferencesRequest extends Request
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
        $salariesString = getCsvConfigKeys('salary-map.candidate-options');
        $beforeDate = Carbon::parse('+6 months');

        return [
            'role_id'              => ['required', 'exists:roles,id'],
            'locations'            => ['required'],
            'locations.*'          => ['required', 'exists:locations,id'],
            'minimum_salary'       => ['required', 'in:' . $salariesString],
            'departments'          => ['required'],
            'departments.*'        => ['required', 'exists:training_seats,id'],
            'travel_abroad'        => ['required', 'boolean'],
            'available_date'       => ['required', 'date', 'before_equal:' . $beforeDate->toDateString()],
            'seeking_permanent'    => ['required_without:seeking_contract', 'boolean'],
            'seeking_contract'     => ['boolean'],
            'law_firm_blacklist.*' => ['exists:law_firms,id'],
        ];
    }
}
