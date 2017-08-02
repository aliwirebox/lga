<?php

namespace App\Http\Controllers\Hirer;

use App\Http\Requests\HirerEditDetailsRequest;
use App\Models\LawFirm;

use Log;
use Mail;

class EditDetailsController extends BaseController
{
    public function index()
    {
        $hirer = getCurrentUser();

        $this->logInfo("views change details");

        return view('app.hirer.edit-details', compact('hirer'));
    }

    public function store(HirerEditDetailsRequest $request)
    {
        $input = $request->only([
            'first_name', 
            'last_name', 
            'email', 
            'telephone'
        ]);

        $hirer = getCurrentUser();

        $lawFirm = LawFirm::with('domains')->findOrFail($hirer->lawFirm->id);

        if (!$lawFirm->isAllowedEmail($input['email'])) {
            $this->logInfo("is blocked from changing their email to " . $input['email']);
            return $this->getDomainBlockedResponse();
        }

        $hirer->update($input);

        $this->logInfo("updated their profile details");

        return $this->getUpdatedResponse();

    }

    protected function getDomainBlockedResponse()
    {
        return redirect()->route('hirer.details.edit')->with('notAllowedDomain', true);
    }

    protected function getUpdatedResponse()
    {
        return redirect()->route('hirer.details.edit')->with('changed', true);
    }
}
