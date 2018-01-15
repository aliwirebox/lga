<?php

function getDomainFromEmail($email)
{
    return strrchr($email, '@');
}

function sendEmailVerification($user)
{
    Log::info("Register: Sending {$user->email} email verification email");

    Mail::queue('app.emails.email-verification', compact('user'), function ($message) use ($user) {
        $message->subject('Verify Email Address');
        $message->to($user->email);
    });
}

function sendEmailDeletedCandidate($candidate)
{
    Log::info("Deleted: Sending {$candidate->email} email deleted candidate email");

    //copy variables because queues can't restore soft deleted models from serialization
    $firstName = $candidate->first_name;
    $email = $candidate->email;

    Mail::queue('app.emails.account-deleted-candidate', compact('firstName'), function ($message) use ($email) {
        $message->subject(config('brand.identity.fullname') . ' – Your account has been deleted');
        $message->to($email);
        $message->bcc(config('brand.email.support'));
    });
}

function sendEmailActivationCandidate($candidate)
{
    Log::info("Register: Sending {$candidate->email} email activation candidate email");

    Mail::queue('app.emails.account-activation-email-candidate', compact('candidate'), function ($message) use ($candidate) {
        $message->from(config('brand.email.support'), config('brand.identity.fullname'));
        $message->subject(config('brand.identity.fullname') . ' - Activate your ' . config('brand.identity.fullname') . ' account');
        $message->to($candidate->email);
        $message->bcc(config('brand.email.support'));
    });
}

function sendEmailActivationHirer($hirer)
{
    Log::info("Register: Sending {$hirer->email} email activation hirer email");

    Mail::queue('app.emails.account-activation-email-hirer', compact('hirer'), function ($message) use ($hirer) {
        $message->subject(config('brand.identity.fullname') . ' - Activate your ' . config('brand.identity.fullname') . ' account');
        $message->to($hirer->email);
        $message->bcc(config('brand.email.support'));
    });
}

function sendEmailWelcomeCandidate($candidate)
{
    Log::info("Register: Sending {$candidate->email} email welcome candidate email");

    Mail::queue('app.emails.welcome-email-candidate', compact('candidate'), function ($message) use ($candidate) {
        $message->subject(config('brand.identity.fullname') . ' - Welcome to ' . config('brand.identity.fullname'));
        $message->to($candidate->email);
        $message->bcc(config('brand.email.support'));
    });
}

function sendEmailWelcomeHirer($hirer)
{
    Log::info("Register: Sending {$hirer->email} email welcome hirer email");

    Mail::queue('app.emails.welcome-email-hirer', compact('hirer'), function ($message) use ($hirer) {
        $message->subject(config('brand.identity.fullname') . ' - Welcome to ' . config('brand.identity.fullname'));
        $message->to($hirer->email);
        $message->bcc(config('brand.email.support'));
    });
}

function sendEmailPasswordChanged($user)
{
    Log::info("Change password: Sending {$user->email} email password changed email");

    Mail::queue('app.emails.password-changed-email', compact('user'), function ($message) use ($user) {
        $message->subject('Password changed');
        $message->to($user->email);
    });
}

function sendEmailReferralCandidate($candidate)
{
    Log::info("Referral candidate: Sending {$candidate->referrer->email} email referral candidate email");

    Mail::queue('app.emails.candidate-referral-candidate', compact('candidate'), function ($message) use ($candidate) {
        $message->subject('Candidate Referral');
        $message->to($candidate->referrer->email);
        $message->bcc(config('brand.email.support'));
    });
}

function sendEmailBlockedHirerDomain($failedRegistration, $lawFirm)
{
    Log::info("Register: {$failedRegistration->email} has been blocked from registering as a hirer for {$lawFirm->name}. Sending email to " . config('brand.email.support'));

    Mail::queue('app.emails.hirer-blocked-domain', compact('failedRegistration', 'lawFirm'), function ($message) {
        $message->subject('Hirer Email Domain Blocked');
        $message->to(config('brand.email.support'));
    });
}

function sendEmailAddLawFirmRequest($failedRegistration)
{
    Log::info("Register: {$failedRegistration->email} cant find their law firm {$failedRegistration->add_law_firm} and requests it to be added. Sending email to " . config('brand.email.support'));

    Mail::queue('app.emails.add-law-firm', compact('failedRegistration'), function ($message) {
        $message->subject('Employer Requests Company Addition');
        $message->to(config('brand.email.support'));
    });
}

function sendEmailContactUs($input)
{
    $mail = config('mail');

    Log::info("Contact Us: Email sent by {$input["email"]}");

    Mail::queue('app.emails.contactus', compact('input'), function ($message) use ($input, $mail) {
        $message->subject('Contact Us');
        $message->to(config('brand.email.support'));
    });
}

function sendEmailCvRequested($search, $candidate)
{
    Log::info("CV Request: {$search->hirer->email} has requested a CV from {$candidate->email} for search {$search->id}");

    Mail::queue('app.emails.cv-requested-email-candidate', compact('search', 'candidate'), function ($message) use ($candidate) {
        $message->subject(config('brand.identity.fullname') . ' - An employer has requested your CV');
        $message->to($candidate->email);
        $message->bcc(config('brand.email.support'));
    });
}

function sendEmailCvRequestRejected($search, $candidate)
{
    Log::info("CV Request: {$candidate->email} has rejected a CV request from {$search->hirer->email} for search {$search->id}");

    $hirer = $search->hirer;

    Mail::queue('app.emails.cv-request-declined-hirer', compact('search', 'candidate', 'hirer'), function ($message) use ($search) {
        $message->subject(config('brand.identity.fullname') .  ' - A CV Request has been declined');
        $message->to($search->hirer->email);
        $message->bcc(config('brand.email.support'));
    });
}

function sendEmailCvRequestAccepted($search, $candidate)
{
    Log::info("CV Request: {$candidate->email} has accepted a CV request from {$search->hirer->email} for search {$search->id}");

    Mail::queue('app.emails.new-cv-request-pending', compact('search', 'candidate'), function ($message) {
        $message->subject('New CV request Pending');
        $message->to(config('brand.email.support'));
    });
}

function sendEmailCandidateDeleteRequest($candidate)
{
    Log::info("Delete Request: email sent to support to request deletion of {$candidate->email}");

    Mail::queue('app.emails.candidate-delete-request', compact('candidate'), function ($message) use ($candidate) {
        $message->subject("Candidate {$candidate->reference} requests to be deleted");
        $message->to(config('brand.email.support'));
    });
}

function sendEmailByMatchStatus($status, $search, $candidate)
{
    switch ($status) {
    case config('match.cv-pending'):
        sendEmailCvRequestAccepted($search, $candidate);
        return true;
        break;

    case config('match.cv-rejected'):
        sendEmailCvRequestRejected($search, $candidate);
        return true;
        break;

    default:
        return false;
    }
}
