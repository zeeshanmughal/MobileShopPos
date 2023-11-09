<?php

namespace App\Http\Controllers;

use App\Models\BuyPhone;
use App\Models\Customer;
use App\Models\CustomerAdditionalInformation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PhoneController extends Controller
{
    //
    public function createPhoneBuy()
    {
        return view('retailer.phone_buy');
    }

    public function storePhoneBuy(Request $request)
    {
        if ($request->has('driving_license')) {
            $licensePath = saveImage($request->driving_license, 'customer_images');
        }
        $validator = Validator::make($request->all(), [
            'driving_license' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'first_name' => 'required|alpha',
            'last_name' => 'required',
            'customer_group' => 'required',
            'device_model' => 'required',
            'device_brand' => 'required',
            'imei' => 'required',
            'buying_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $is_customer = Customer::where('id', $request->customer_id)->with('additionalInformation')->first();

        if (!$is_customer) {
            $customer = new Customer();
            $customer->uuid = Str::uuid();
            $customer->slug = createSlug($request->first_name . $request->last_name);
            $customer->customer_group = $request->customer_group;
            $customer->first_name = $request->first_name;
            $customer->last_name = $request->last_name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;

            if ($customer->save()) {
                $customer_id = $customer->id;
                $additionalInformation =  new CustomerAdditionalInformation();
                $additionalInformation->customer_id = $customer->id;
                $additionalInformation->driving_license = $licensePath;
                $additionalInformation->email_notification = $request->email_notification;
                $additionalInformation->sms_notification = $request->sms_notification;
                $additionalInformation->save();
            }
        } else {
            $customer_id = $is_customer->id;

            if($is_customer->customer_group !== $request->customer_group){
                $is_customer->customer_group =$request->customer_group;
            }
            if($is_customer->first_name !== $request->first_name){
                $is_customer->first_name =$request->first_name;
            }
            if($is_customer->last_name !== $request->last_name){
                $is_customer->last_name =$request->last_name;
            }
            if($is_customer->email !== $request->email){
                $is_customer->email =$request->email;
            }
            if($is_customer->phone !== $request->phone){
                $is_customer->phone =$request->phone;
            }
        //    if($is_customer->additonalInformation && $is_customer->additionalInformation->driving_license != $licensePath){
        //     $is_customer->additionalInformation->driving_license = $licensePath;
        //    }else{
        //     $additionalInformation =  new CustomerAdditionalInformation();
        //     $additionalInformation->customer_id = $is_customer->id;
        //     $additionalInformation->driving_license = $licensePath;
           
        //    }

        //    if( $is_customer->additonalInformation && $is_customer->additionalInformation->email_notification != $request->email_notification){
        //     $is_customer->additionalInformation->email_notification = $request->email_notification;
        //    }else{
        //     $additionalInformation =  new CustomerAdditionalInformation();
        //     $additionalInformation->customer_id = $is_customer->id;
        //     $additionalInformation->email_notification = $request->email_notification;
        //    }

        //    if( $is_customer->additonalInformation &&  $is_customer->additionalInformation->sms_notification != $request->sms_notification){
        //     $is_customer->additionalInformation->sms_notification = $request->sms_notification;
        //    }else{
        //     $additionalInformation =  new CustomerAdditionalInformation();
        //     $additionalInformation->customer_id = $is_customer->id;
        //     $additionalInformation->sms_notification = $request->sms_notification;
        //    }
           if($is_customer->save()){
            // $additionalInformation->save();
           }

        }
        $phone = new BuyPhone();
        $phone->user_id = Auth::user()->id;
        $phone->customer_id = $customer_id;
        $phone->device_model = $request->device_model;
        $phone->device_brand = $request->device_brand;
        $phone->imei = $request->imei;
        $phone->buying_price = $request->buying_price;
        $phone->sell_price = $request->selling_price;
        $phone->save();



        return redirect()->route('retailer.phones')->with('success', 'Mobile added successfully');
    }

    public function phoneList(){
        $phones = BuyPhone::orderBy('id','desc')->get();
        return view('retailer.phones',compact('phones'));
    }

    public function createPhoneSell()
    {
        return view('retailer.phone_sell');
    }
}
