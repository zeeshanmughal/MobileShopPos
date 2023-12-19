<?php

namespace App\Http\Controllers;

use App\Models\PaymentPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\SetupIntent;

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


    public function handleDirectDebitSetup(Request $request)
    {
        $user = Auth::user();

        // Create a SetupIntent to set up a new payment method (bank account)
        $intent = $user->createSetupIntent();

        return view('user.payment.setup', compact('intent'));
    }


  public function subscribe(Request $request)
    {
        $user = Auth::user();

        // Attach the payment method to the user
        $user->createOrGetStripeCustomer();
        $user->updateDefaultPaymentMethod($request->payment_method);

        // Subscribe the user to a plan (replace 'price_123' with your actual Stripe Price ID)
        $user->newSubscription('default', 'price_123')
            ->trialDays(30) // Set the trial period to 30 days (1 month)
            ->create();

        return redirect()->route('dashboard')->with('success', 'Subscription created successfully');
    }
}
