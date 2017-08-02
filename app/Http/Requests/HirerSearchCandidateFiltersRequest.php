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
        $degrees = getCsvConfigKeys('degree-class.search-options');
        
        $rules = [
            'ucas_points'                 => ['numeric', 'max:999'],
            'universities.*'              => ['exists:universities,id'],
            'degree_class'                => ['in:' . $degrees],
            'training_law_firm_bands.*'   => ['exists:law_firm_bands,id'],
            'training_law_firm_bands.*.*' => ['exists:law_firm_bands,id'],
            'client_secondment'           => ['required'],
            'training_seats.*'            => ['exists:training_seats,id'],
            'languages.*'                 => ['exists:languages,id'],
        ];

        if (!$this->user()->agreed_terms) {
            $rules['agreed_terms'] = ['required','boolean'];
        }

        return $rules;
    }
}
