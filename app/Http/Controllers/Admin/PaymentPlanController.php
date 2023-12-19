<?php

namespace App\Http\Controllers\Admin;

use Stripe\Price;
use Stripe\Stripe;
use Stripe\Product;
use App\Models\PaymentPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentPlanController extends Controller
{
    //
    public function index()
    {
        $paymentPlans = PaymentPlan::orderBy('created_at', 'asc')->get();
        return view('admin.payment_plans', compact('paymentPlans'));
    }


    public function store(Request $request)
    {
        // Validate and store the new payment plan
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'interval' => 'required',
        ]);
        // Generate slug from the name using the Helper function
        $slug = createSlug($validatedData['name']);
        $name = $request->input('name');
        $price = $request->input('price');
        $duration = $request->input('interval');
        // Add the slug to the validated data
        $validatedData['slug'] = $slug;

        Stripe::setApiKey('sk_test_51OHmLRL09JSTkbRcDqXMlKM1FfRtaWsRHhlamwGC141mV2wZjuDCbHO3agNwxIToq2UZ7ZecIiFK1mB96YYjuWcT00zQL7vY8c');
        // Stripe::setApiKey(config('services.stripe.secret'));

        // Check if the product already exists in Stripe
        // $existingProduct = Product::all(['name' => $name])->data;
        // if (count($existingProduct) > 0) {
        //     // Product already exists, use the existing product
        //     $product = $existingProduct[0];
        // }
        // Create a product in Stripe
        $product = Product::create([
            'name' => $name,
            'type' => 'service', // Adjust this based on your product type
        ]);

        // Create a price in Stripe
 


        // Store the relevant information, including the Stripe Price ID, in your database
        $paymentPlan = PaymentPlan::create([
            'name' => $name,
            'price' => $price,
            'interval' => $duration,
            'stripe_price_id' => $stripePrice->id, // Store the Price ID
        ]);

        return response()->json($paymentPlan, 200);
    }

    public function edit(PaymentPlan $payment_plan)
    {
        return response()->json($payment_plan);
    }


    public function update(Request $request, $payment_plan)
    {
        // Assuming PaymentPlan is the corresponding model
        $paymentPlan = PaymentPlan::findOrFail($payment_plan);

        // Retrieve the associated Stripe Price
        $stripePrice = Price::retrieve($paymentPlan->stripe_price_id);
        // Retrieve the associated Stripe Product
        $product = Product::retrieve($stripePrice->product);

        // $paymentPlan->id = $request->input('id');
        $paymentPlan->name = $request->input('name');
        $paymentPlan->price = $request->input('price');
        $paymentPlan->interval = $request->input('interval');

        $paymentPlan->save();

        // Update the associated Stripe Product
        $product->name = $request->input('name'); // Update with the new name
        $product->save();

        // Update the associated Stripe Price
        $stripePrice->unit_amount = $request->input('price') * 100; // Update with the new price
        $stripePrice->recurring->interval_count = $request->input('interval'); // Update with the new interval
        $stripePrice->save();

        return response()->json($paymentPlan, 200);
    }

    public function destroy($payment_plan)
    {
        $paymentPlan = PaymentPlan::findOrFail($payment_plan);
        // Retrieve the associated Stripe Price
        $stripePrice = Price::retrieve($paymentPlan->stripe_price_id);

        // Retrieve the associated Stripe Product
        $product = Product::retrieve($stripePrice->product);

        // Delete the product
        $product->delete();
        $paymentPlan->delete();

        return response()->json(['message' => 'Payment plan deleted successfully'], 200);
    }
}
