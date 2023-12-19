<?php

namespace App\Http\Controllers\Admin;

use Log;
use Stripe\Price;
use Stripe\Stripe;
use Stripe\Product;
use App\Models\User;
use Stripe\Customer;
use App\Models\PaymentPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe\Exception\InvalidRequestException;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        $users = User::count();
        $payment_plans = PaymentPlan::count();
        return view('admin.dashboard', compact('users', 'payment_plans'));
    }

    public function users()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('admin.users', compact('users'));
    }

    public function makeUserActive($id)
    {


        $user = User::findOrFail($id);

        if ($user->status != 'active') {

            $user->status = 'active';
            if($user->save()){
                return redirect()->route('admin.users')
                        ->with('success', 'User status changed to active');
            }else{
                return redirect()->route('admin.users')
                        ->with('success', 'Failed to change user status');
            }
        //     try {

        //         Stripe::setApiKey(config('services.stripe.secret'));


        //         if (!$user->stripe_id) {
        //             // Create a new Stripe customer
        //             $customer = Customer::create([
        //                 'email' => $user->email,
        //                 // Add any additional customer attributes as needed
        //             ]);
        //             // Update the user's stripe ID
        //             $user->stripe_id = $customer->id;
        //             $user->save();
        //         } else {
        //             try {
        //                 $customer = Customer::retrieve($user->stripe_id);
        //             } catch (InvalidRequestException $e) {
        //                 // Customer not found, create a new one
        //                 $customer = Customer::create([
        //                     'email' => $user->email,
        //                     // Add any additional customer attributes as needed
        //                 ]);

        //                 // Update the user's Stripe ID
        //                 $user->stripe_id = $customer->id;
        //                 $user->save();
        //             }
        //         }
        //         $product = $this->findOrCreateStripeProduct('free_trial', 'Free Trial');


        //         if (!$user->subscribed('default')) {
        //             // Check if the price for the product already exists
        //             $price = Price::retrieve($product->id); // Replace 'your_price_id' with the actual Price ID

        //             if (!$price) {
        //                 // Create a 30-day trial subscription with 0 price
        //                 $price = Price::create([
        //                     'product' => $product->id,
        //                     'unit_amount' => 0,
        //                     'currency' => 'usd',
        //                     'recurring' => [
        //                         'interval' => 'month',
        //                         'interval_count' => 1,
        //                     ],
        //                 ]);
        //             }


        //             // Subscribe the user to the product
        //             $user->newSubscription('default', $price->id)
        //                 ->trialDays(30)
        //                 ->create();



        //             // Update the user's status to active
        //             $user->status = 'active';
        //             $user->save();

        //             return redirect()->route('admin.users')
        //                 ->with('success', 'User status changed to active, and 30-day trial subscription created.');
        //         } else {

        //             return redirect()->route('admin.users')
        //             ->with('error', 'User is already subscribed.');
        //         }
        //     } catch (InvalidRequestException $e) {
                
        //         // Handle the case where the customer is not found
        //         return redirect()->route('admin.users')
        //             ->with('error', $e->getMessage());
        //     }
        // } else {
            // return redirect()->route('admin.users')
            //     ->with('error', 'User is already active.');
        }
    }




    private function findOrCreateStripeProduct($productId, $productName)
    {
        try {

            // Initialize Stripe with your secret key
            Stripe::setApiKey(config('services.stripe.secret'));

            // Check if the product already exists in Stripe
            $existingProduct = Product::retrieve($productId);
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Product not found, create a new one
            $existingProduct = Product::create([
                'id' => $productId,
                'name' => $productName,
                'type' => 'service',
                // Add any additional attributes as needed
            ]);
        }

        return $existingProduct;
    }
}
