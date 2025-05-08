<?php

namespace App\Traits;

use App\Models\AuthenticationRequest;
use Illuminate\Support\Facades\Auth;

trait ApprovalRequest
{
    public static function isApproval($userId, $browser)
    {
        // Ensure the user is logged in
        if (!Auth::check()) {
            return false;
        }


        // Ensure the browser parameter is provided
        if (empty($browser)) {
            return false;
        }

        // Fetch the approval record for the user and browser
        $authRequest = AuthenticationRequest::where([
            ['user_id', '=', $userId],
            ['browser', '=', $browser],
            ['is_confirm', '=', 1],
        ])->get();

        foreach ($authRequest as $auth) {
            $cookieValue = request()->cookie($auth->approval_secret);
            if ($auth->approval == 1 && $cookieValue != null) {
                return true;
            }
        }

        return false;
    }

    public static function sendRequest($browser, $userId)
    {
        if (empty($browser)) {
            return null;
        }
    
        // Check for existing unconfirmed request
        $existingRequest = AuthenticationRequest::where('user_id', $userId)
            ->where('browser', $browser)
            ->where('is_confirm', 0)
            ->first();
    
        if ($existingRequest) {
            return $existingRequest;
        }
    
        // Create new request if none found
        return AuthenticationRequest::create([
            'user_id' => $userId,
            'browser' => $browser,
        ]);
    }
    



    public static function savedCookie($id)
    {

        $authRequest =  AuthenticationRequest::find($id);
        if ($authRequest) {
            $authRequest->is_confirm = 1;
            $authRequest->update();
        }
    }
}
