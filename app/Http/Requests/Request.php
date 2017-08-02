<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Log;

abstract class Request extends FormRequest
{
    public function response(array $errors)
    {
        Log::info(sprintf("%s from %s failed validation", static::class, $this->getUserLogIdentifier()), $errors);
        
        return parent::response($errors);
    }

    public function forbiddenResponse()
    {
        Log::info(sprintf("%s from %s was forbidden", static::class, $this->getUserLogIdentifier()));

        return parent::forbiddenResponse();
    }

    protected function getUserLogIdentifier()
    {
        $id = 'a guest user';
        $user = $this->user();

        if ($user) {
            $id = $user->email;
        }

        return $id;
    }
}
