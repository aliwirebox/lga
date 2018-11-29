<?php

namespace App\Http\Controllers\Hirer;

use App\Http\Requests\HirerRegisterRequest;
use App\Models\FailedHirerRegistration;
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
        $token = $request->input('g-recaptcha-response');
        $addLawFirm = $request->input('add_law_firm', false);

        if ($addLawFirm) {
            return $this->getAddLawFirmResponse($request);
        }

        $lawFirm = LawFirm::with('domains')->findOrFail($request->input('law_firm_id'));

        if (!$lawFirm->isAllowedEmail($request->input('email'))) {
            return $this->getDomainBlockedResponse($request, $lawFirm);
        }


  if ($token) {
        return $this->getRegisteredResponse($request, $lawFirm);
         }else{
        return redirect('register');

    }
    }

    protected function getDomainBlockedResponse($request, $lawFirm)
    {
        $input = $request->only([
            'first_name',
            'last_name',
            'email',
            'telephone',
            'password',
            'law_firm_id',
        ]);

        $input['password'] = bcrypt($input['password']);

        $failedRegistration = FailedHirerRegistration::create($input);

        sendEmailBlockedHirerDomain($failedRegistration, $lawFirm);

        return redirect()->route('hirer.register')->with('notAllowedDomain', true);
    }

    protected function getAddLawFirmResponse($request)
    {
        $input = $request->only([
            'first_name',
            'last_name',
            'email',
            'telephone',
            'password',
            'add_law_firm',
        ]);

        $input['password'] = bcrypt($input['password']);

        $failedRegistration = FailedHirerRegistration::create($input);

        sendEmailAddLawFirmRequest($failedRegistration);

        return redirect()->route('hirer.register')->with('addCompany', true);
    }

    protected function getRegisteredResponse($request, $lawFirm)
    {
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

        return redirect()->route('hirer.register')->with('registered', true);
    }
}
