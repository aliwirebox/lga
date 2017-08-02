<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

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

        return [
            'locations'         => ['required'],
            'lcoations.*'       => ['required', 'exists:locations,id'],
            'minimum_salary'    => ['required', 'in:' . $salariesString],
            'departments'       => ['required'],
            'departments.*'     => ['required', 'exists:training_seats,id'],
            'type_of_firms'     => ['required', 'exists:law_firm_bands,id'],
            'type_of_firms.*'   => ['required', 'exists:law_firm_bands,id'],
            'type_of_firms.*.*' => ['required', 'exists:law_firm_bands,id'],
        ];
    }
}
