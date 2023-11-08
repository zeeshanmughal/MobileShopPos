<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    //
    public function getLogin(){
        if(auth()->guard('admin')->check()){
            return redirect()->route('admin.dashboard');
        }else{
            return view('admin.auth.login');

        }
    }

    public function postLogin(Request $request)
    {
        
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
 
        if(auth()->guard('admin')->attempt(['email' => $request->input('email'),  'password' => $request->input('password')])){
            $user = auth()->guard('admin')->user();
            // if($user->is_admin == 1){
          

                return redirect()->route('admin.dashboard')->with('success','You are Logged in sucessfully.');
            // }
        }else {
            return back()->with('error','Whoops! invalid email and password.');
        }
    }
 
    public function adminLogout(Request $request)
    {
        auth()->guard('admin')->logout();
        Session::flush();
        Session::put('success', 'You are logout sucessfully');
        return redirect(route('adminLogin'));
    }
}
