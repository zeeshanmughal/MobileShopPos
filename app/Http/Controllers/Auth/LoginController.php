<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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
    {   dd('here');
        if ($user->status !== 'approved') {
            auth()->logout();
            return back()->with('warning', 'You can login once your account will be approved by authorities.');
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            // return redirect()->route('user.dashboard');
        }
        return redirect()->intended($this->redirectPath());
    }
}
