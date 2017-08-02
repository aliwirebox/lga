<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Carbon\Carbon;

class HirerSearchCandidateFiltersUpdateRequest extends HirerSearchCandidateFiltersRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = $this->getBaseRules();
        $before = Carbon::now()->startOfMonth()->addMonths(24);

        //add validation to qualified_date_from to check if the date is always before_equal to the existing value

        $rules['qualified_date_from'] = ['required', 'date', 'before_equal:' . $before->toDateString()];
        $rules['qualified_date_to'] = ['required', 'date', 'after:qualified_date_from', 'before_equal:' . $before->toDateString()];

        return $rules;
    }
}
