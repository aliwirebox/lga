<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Carbon\Carbon;

class HirerSearchCandidateFiltersCreateRequest extends HirerSearchCandidateFiltersRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = $this->getBaseRules();
        $after = Carbon::now()->startOfMonth()->subMonths(24);
        $before = Carbon::now()->startOfMonth()->addMonths(24);

        $rules['qualified_date_from'] = ['date', 'before_equal:' . $before->toDateString(), 'after_equal:' . $after->toDateString()];
        $rules['qualified_date_to'] = ['date', 'after:qualified_date_from', 'before_equal:' . $before->toDateString()];

        return $rules;
    }
}
