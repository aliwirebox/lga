<?php

namespace App\Http\Requests;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Request;
use Log;

class CandidateCvRequestResponseRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
           'status' => 'required|in:' . config('match.cv-rejected') . ',' . config('match.cv-pending'),
        ];
    }

    public function response(array $errors)
    {
        Log::warning('Validation failed CandidateCvRequestResponseRequest, this should only for malicious users', [
            'errors'       => $errors,
            'request-vars' => $this->all(),
            'user'         => $this->getUserLogIdentifier(),
        ]);

        if (($this->ajax() && ! $this->pjax()) || $this->wantsJson()) {
            return new JsonResponse($errors, 422); //if validation fails for ajax requests from datatables
        }

        return new Response('Invalid Request', 422); //if validation fails for email link. Normal behaviour is to redirect to a form
    }
}
