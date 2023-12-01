<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserVerify;

class VerificationController extends Controller
{
    //
    public function verifyAccount($token)
    {
        $token = $token;
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'Sorry your email cannot be identified.';

        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;
            if (!$user->is_email_verified) {

                $verifyUser->user->is_email_verified = 1;
                if ($verifyUser->user->save()) {
                    return view('auth.registration-success', compact('token'));
                }
                // Now that the email is verified, check if the trial period has ended
                if ($user->subscribed('default') && $user->subscription('default')->onTrial()) {
                    $trialEndsAt = $user->subscription('default')->trial_ends_at;

                    // Check if the trial period has ended
                    if (now()->gte($trialEndsAt)) {
                        // The trial period has ended, prompt the user to add a payment method to continue
                        $message = "Your 30-day free trial has ended. Please add a payment method to continue using the service.";
                    } else {
                        // The trial period is still ongoing
                        $message = "Your e-mail is verified, and you are currently on a 30-day free trial. If your account is approved by Admin, you can continue using the service during the trial period.";
                    }
                } else {
                    $message = "Your e-mail is verified. If you account is approved by Admin, you can now login. ";
                }
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }

        return redirect()->route('login')->with('message', $message);
    }
}
