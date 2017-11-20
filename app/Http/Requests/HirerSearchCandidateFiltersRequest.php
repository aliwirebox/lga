<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Carbon\Carbon;

class HirerSearchCandidateFiltersRequest extends Request
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

    protected function getBaseRules()
    {
        $rules = [
            'has_degree'                  => ['required', 'boolean'],
            'has_lpc'                     => ['required', 'boolean'],
            'member_institute_paralegals' => ['required', 'boolean'],
            'member_of_cilex'             => ['required', 'boolean'],
            'years_experience'            => ['required', 'integer'],
            'training_seats'              => ['max:8'],
            'training_seats.*'            => ['exists:training_seats,id'],
            'languages.*'                 => ['exists:languages,id'],
        ];

        return $rules;
    }
}
