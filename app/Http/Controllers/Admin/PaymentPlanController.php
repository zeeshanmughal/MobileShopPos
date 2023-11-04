<?php

namespace App\Http\Controllers\Admin;

use App\Models\PaymentPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentPlanController extends Controller
{
    //
    public function index()
    {
        $paymentPlans = PaymentPlan::orderBy('created_at','asc')->get();
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

        // Add the slug to the validated data
        $validatedData['slug'] = $slug;

        $paymentPlan = PaymentPlan::create($validatedData);

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


        // $paymentPlan->id = $request->input('id');
        $paymentPlan->name = $request->input('name');
        $paymentPlan->price = $request->input('price');
        $paymentPlan->interval = $request->input('interval');

        $paymentPlan->save();

        return response()->json($paymentPlan, 200);
    }

    public function destroy($payment_plan)
    {
        $paymentPlan = PaymentPlan::findOrFail($payment_plan);
        $paymentPlan->delete();

        return response()->json(['message' => 'Payment plan deleted successfully'], 200);
    }
}
