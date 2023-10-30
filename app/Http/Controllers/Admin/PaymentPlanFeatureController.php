<?php

namespace App\Http\Controllers\Admin;

use App\Models\PaymentPlan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PaymentPlanFeature;
use App\Http\Controllers\Controller;

class PaymentPlanFeatureController extends Controller
{
    //

    public function index(PaymentPlan $payment_plan)
    {
        $payment_plan_id = $payment_plan->id;
        $payment_plan_features = PaymentPlanFeature::where('payment_plan_id',$payment_plan_id)->get();
        return view('admin.payment_plan_features', compact('payment_plan','payment_plan_features'));
    }


    public function store(Request $request)
    {

      
           
        // Validate and store the new payment plan
        $validatedData = $request->validate([
            'feature_detail' => 'required',
            'payment_plan_id'=>'required',
        ]);
        // Generate slug from the name using the Helper function
        // $slug = createSlug($validatedData['name']);

        // Add the slug to the validated data
        $validatedData['slug'] = Str::random(5);
        $planFeature = PaymentPlanFeature::create($validatedData);

        return response()->json($planFeature, 200);
    }

    public function edit($featureId)
    {
        $feature = PaymentPlanFeature::where('id',$featureId)->first();
        return response()->json($feature,200);
    }


    public function update(Request $request, $payment_plan)
    {
        // Assuming PaymentPlan is the corresponding model
        

        $planFeature = PaymentPlanFeature::findOrFail($payment_plan);


        // $paymentPlan->id = $request->input('id');
        // $planFeature->slug = Str::random(5);
        $planFeature->feature_detail = $request->input('feature_detail');

        $planFeature->save();

        return response()->json($planFeature, 200);
    }

    public function destroy($payment_plan)
    {
        $planFeature = PaymentPlanFeature::findOrFail($payment_plan);
        
        $planFeature->delete();

        return response()->json(['message' => 'Payment plan deleted successfully'], 200);
    }
}
