<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BrandAdminCreateLawFirmRequest extends Request
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
        return [
            'name' => [
                'required',
                'unique:law_firms,name,NULL,id,deleted_at,NULL',
            ],
        ];
    }

    public function getDomains()
    {
        $input = $this->input('domains');

        if (!$input) {
            return null;
        }

        return collect(explode(',', $input))
            ->map(function ($domain) {
                return strtolower(trim($domain));
            })
            ->filter()
            ->map(function ($domain) {
                return ['name' => $domain];
            })
            ->toArray();
    }
}
