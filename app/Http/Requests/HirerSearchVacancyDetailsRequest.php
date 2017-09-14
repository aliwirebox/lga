<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class HirerSearchVacancyDetailsRequest extends Request
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
        $salariesString = getCsvConfigKeys('salary-map.vacancy-options');

        $rules =  [
            'location'               => ['required', 'exists:locations,id'],
            'salary'                 => ['required', 'in:' . $salariesString],
            'departments'            => ['required', 'exists:training_seats,id'],
            'additional_information' => []
        ];
        if (!$this->user()->agreed_terms) {
            $rules['agreed_terms'] = ['required','boolean'];
        }
        return $rules;
    }
}
