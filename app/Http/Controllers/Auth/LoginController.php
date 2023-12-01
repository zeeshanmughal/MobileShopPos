<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {  
        if ($user->status == 'active' && $user->is_email_verified == 1) {
        //    Auth::attempt(['email'=>$user->email,'password'=>$user->password]);
            return redirect()->route('retailer.dashboard');
        } 
        else {
        
           
            if ($user->status != 'active') {
                return back()->with('info', 'You account is not approved by Admin. Contact to Support or Wait for Approval');
            } 
            if ($user->is_email_verified != 1) {
                return back()->with('error', 'Your email is not verified. Please check your email for verification instructions.');
            }
            Auth::logout();
            
        }
    }

   

 
}
