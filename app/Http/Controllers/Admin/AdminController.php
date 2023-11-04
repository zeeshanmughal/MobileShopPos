<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\PaymentPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        $users = User::count();
        $payment_plans = PaymentPlan::count();
        return view('admin.dashboard',compact('users','payment_plans'));
    }

    public function users()
    {
        $users = User::where('role','!=', 'admin')->get();
        return view('admin.users', compact('users'));
    }

    public function makeUserActive($id)
    {
        $user = User::findOrFail($id);

        if ($user->status === 'pending') {
            $user->status = 'active';
            $user->save();

            return redirect()->route('admin.users')
                ->with('success', 'User status changed to active.');
        } else {
            return redirect()->route('admin.users')
                ->with('error', 'User is already active.');
        }
    }
}
