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
        $input = $request->only([
            'first_name',
            'last_name',
            'email',
            'telephone',
            'law_firm_id',
            'password',
        ]);

        $input['password'] = bcrypt($input['password']);

        $lawFirm = LawFirm::with('domains')->findOrFail($input['law_firm_id']);

        if (!$lawFirm->isAllowedEmail($input['email'])) {
            $this->alertBrandSupportAboutBlockedHirerDomain($input, $lawFirm);

            return $this->getDomainBlockedResponse();
        }

        $hirer = Hirer::create($input);

        Log::info("Register: {$hirer->email} has registerd as a hirer for {$lawFirm->name}");

        sendEmailActivationHirer($hirer);

        return $this->getRegisteredResponse();
    }

    protected function alertBrandSupportAboutBlockedHirerDomain($input, $lawFirm)
    {
        Log::info("Register: {$input['email']} has been blocked from registering as a hirer for {$lawFirm->name}. Sending email to " . config('brand.identity.initials'));

        Mail::queue('app.emails.hirer-blocked-domain', compact('input', 'lawFirm'), function ($message) {
            $message->subject('Hirer Email Domain Blocked');
            $message->to(config('brand.email.support'));
        });
    }

    protected function getDomainBlockedResponse()
    {
        return redirect()->route('hirer.register')->with('notAllowedDomain', true);
    }

    protected function getRegisteredResponse()
    {
        return redirect()->route('hirer.register')->with('registered', true);
    }
}
