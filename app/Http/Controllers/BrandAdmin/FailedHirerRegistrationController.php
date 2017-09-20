<?php

namespace App\Http\Controllers\BrandAdmin;

use App\Models\FailedHirerRegistration;
use App\Models\LawFirm;
use Illuminate\Support\Facades\Validator;

class FailedHirerRegistrationController extends BaseController
{
    public function approve(FailedHirerRegistration $failedRegistration)
    {
        $validator = Validator::make(['email' => $failedRegistration->email], [
            'email' => 'required|email|max:255|unique:candidates,email|unique:hirers,email|unique:brand_admins,email',
        ]);

        if ($validator->fails()) {
            return $this->getValidationFailedResponse();
        }

        if ($failedRegistration->law_firm_id) {
            $lawFirm = LawFirm::findOrFail($failedRegistration->law_firm_id);
        } else {
            $lawFirm = LawFirm::create(['name' => $failedRegistration->add_law_firm]);
        }

        $lawFirm->domains()->create(['name' => getDomainFromEmail($failedRegistration->email)]);

        $hirerData = $failedRegistration->makeHidden('add_law_firm')->toArray();

        $hirer = $lawFirm->hirers()->create($hirerData);

        sendEmailActivationHirer($hirer);

        return $this->getSuccessResponse();
    }

    protected function getValidationFailedResponse()
    {
        return view('app.brand-admin.failed-hirer-registration', ['outcome' => 'The email has already been taken']);
    }

    protected function getSuccessResponse()
    {
        return view('app.brand-admin.failed-hirer-registration', ['outcome' => 'Hirer registration approved']);
    }
}
