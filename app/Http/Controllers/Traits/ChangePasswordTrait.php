<?php

namespace App\Http\Controllers\Traits;

use App\Http\Requests\ChangePasswordRequest;
use Hash;
use Log;

trait ChangePasswordTrait
{
    public function store(ChangePasswordRequest $request)
    {
        $user = getCurrentUser();

        if (!Hash::check($request->currentpassword, $user->password)) {
            return $this->getInvalidResponse($user);
        }
        
        $user->fill([
            'password' => Hash::make($request->password_confirmation)
        ])->save();

        return $this->getSuccessResponse($user);
    }
    
    protected function getSuccessResponse($user)
    {
        Log::info("Change password: {$user->email} has changed his password");

        sendEmailPasswordChanged($user);
        
        return redirect()->route($this->path)->with('changed',true);
    }
    
    protected function getInvalidResponse($user)
    {
        Log::info("Invalid current password: {$user->email} has tried to change his password");
        return redirect()->route($this->path)->withErrors(['Invalid current password']);
    }
    
}
