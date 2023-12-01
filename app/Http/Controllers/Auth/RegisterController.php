<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Set the default 30-day trial for the user without a payment method
        $user->newSubscription('default', 'price_1OIFITL09JSTkbRcRYmp6gvV') // Replace with the actual Stripe Price ID
            ->trialDays(30) // Set the trial period to 30 days (1 month)
            ->create();
        return $user;
    }

    protected function registered(Request $request, $user)

    {
        $token = Str::random(64);

        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token
        ]);

        Mail::send('emails.email_verification', ['token' => $token], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Email Verification Mail');
        });
        return redirect()->route('user.verify', ['token' => $token])->with('message', 'An email has been sent to your provided email address. Please check your inbox and follow the instructions to verify your email.');
        // return view('auth.registration-success',compact('token'));
    }

  
}
