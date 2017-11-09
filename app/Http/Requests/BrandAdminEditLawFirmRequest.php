<?php

namespace App\Http\Requests;

class BrandAdminEditLawFirmRequest extends BrandAdminCreateLawFirmRequest
{
    public function rules()
    {
        $lawFirm = $this->route('lawFirm');

        return [
            'name' => [
                'required',
                "unique:law_firms,name,{$lawFirm->id},id,deleted_at,NULL",
            ],
        ];
    }
}
