<?php

namespace App\Http\Controllers\Hirer;

use App\Http\Requests\HirerRegisterRequest;
use App\Models\Hirer;
use App\Models\LawFirm;
use Log;
use Mail;

class RegisterController extends BaseController
{
    public function __construct()
    {
        //Overwrite auth middleware so anybody can register
        $this->middleware('guest');
    }

    public function index()
    {
        return view('app.hirer.register');
    }

    public function store(HirerRegisterRequest $request)
    {
        $addLawFirm = $request->input('add_law_firm', false);

        if ($addLawFirm) {
            sendEmailAddLawFirmRequest($request->all());

            return $this->getAddCompanyResponse();
        }

        $lawFirm = LawFirm::with('domains')->findOrFail($request->input('law_firm_id'));

        if (!$lawFirm->isAllowedEmail($request->input('email'))) {
            sendEmailBlockedHirerDomain($request->all(), $lawFirm);

            return $this->getDomainBlockedResponse();
        }

        $input = $request->only([
            'first_name',
            'last_name',
            'email',
            'telephone',
            'law_firm_id',
            'password',
        ]);

        $input['password'] = bcrypt($input['password']);

        $hirer = Hirer::create($input);

        Log::info("Register: {$hirer->email} has registerd as a hirer for {$lawFirm->name}");

        sendEmailActivationHirer($hirer);

        return $this->getRegisteredResponse();
    }

    protected function getDomainBlockedResponse()
    {
        return redirect()->route('hirer.register')->with('notAllowedDomain', true);
    }

    protected function getAddCompanyResponse()
    {
        return redirect()->route('hirer.register')->with('addCompany', true);
    }

    protected function getRegisteredResponse()
    {
        return redirect()->route('hirer.register')->with('registered', true);
    }
}
