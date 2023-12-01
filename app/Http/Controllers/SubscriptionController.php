<?php

namespace App\Http\Controllers;

use App\Models\PaymentPlan;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    //
    public function showSubscriptionForm()
    {
        return view('subscribe');
    }

    // public function subscribe(Request $request)
    // {
    //     $request->user()->newSubscription('default', 'plan_id')->create($request->paymentMethod);

    //     return redirect('/dashboard')->with('success', 'Subscription successful!');
    // }


    public function showSubscriptionPlans(){
       $paymentPlans =  PaymentPlan::all();
       return view('retailer.payment_plans',compact('paymentPlans'));
    }
    public function subscribe(Request $request, $planId)
    {
        $plan = PaymentPlan::findOrFail($planId);
        $user = $request->user();

        // Subscribe the user to the selected plan
        $user->newSubscription($plan->name, $plan->stripe_price_id)->create($request->paymentMethod);

        return redirect('/dashboard')->with('success', 'Subscription successful!');
    }
}
