<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{

        
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
                    // return view('auth.registration-success', compact('token'));
                    $message = "Your e-mail is verified. If you account is approved by Admin, you can now login. ";

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
   
    public function resend_verification_email(Request $request){
        $userId = $request->user;
        if($userId){
           $user =  User::where('id', $userId)->first();
           if($user && $user->is_email_verified !== 1){

            $userVerify = UserVerify::where('user_id',$user->id)->first();
            $token = Str::random(64);

            if($userVerify){
                $userVerify->token = $token;
                $userVerify->update();
            }else{
                UserVerify::create([
                    'user_id' => $user->id,
                    'token' => $token
                ]);
            }

           
    
            Mail::send('emails.email_verification', ['token' => $token], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Email Verification Mail');
            });

            return view('auth.registration-success',compact('token','user'))->with('resent',true);
           }else{
            return redirect()->route('login');
        }

    }else{
        return redirect()->route('login');
    }
}
}
