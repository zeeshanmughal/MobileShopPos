<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\Customer;
use App\Models\BillDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\CustomerAdditionalInformation;
use PDF;

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
        $customer = Customer::where('id', $request->customer_id)->with('additionalInformation')->first();

        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not found! Create New Customer');
        } else {
            if ($request->sms_notification == null) {
                $sms_notification = 0;
            } else {
                $sms_notification = 1;
            }
            if ($request->email_notification == null) {
                $email_notification = 0;
            } else {
                $email_notification = 1;
            }
            $dataCustomerAdditional = [
                'driving_license' => $request->driving_licese,
                'sms_notification' => $sms_notification,
                'email_notification' => $email_notification,

            ];
            $conditionCustomerAdditional = [
                'customer_id' => $customer->id
            ];
            $customerAdditional = CustomerAdditionalInformation::updateOrCreate($conditionCustomerAdditional, $dataCustomerAdditional);


            $phone = new Phone();
            $phone->user_id = Auth::user()->id;
            $phone->customer_id = $customer->id;
            $phone->label_id = Str::random(10);
            $phone->status = 'buy';
            $phone->device_model = $request->device_model;
            $phone->device_brand = $request->device_brand;
            $phone->imei = $request->imei;
            $phone->buying_price = $request->buying_price;
            $phone->sell_price = $request->selling_price;
            if ($phone->save()) {
                return redirect()->route('retailer.phones')->with('success', 'Mobile added successfully');
            } else {
                return redirect()->route('retailer.phone_buy')->with('error', 'Failed to add phone');
            }
        }
    }

    public function phoneList()
    {
        $phones = Phone::orderBy('id', 'desc')->paginate(5);
        return view('retailer.phones', compact('phones'));
    }

    public function createPhoneSell()
    {
        return view('retailer.phone_sell');
    }

    public function searchPhones(Request $request)
    {


        // Check if phone_model is provided in the request
        if ($request->has('search_input')) {
            $searchInput = $request->input('search_input');
            $phones = Phone::where('label_id', 'like', '%' . $searchInput . '%')
                ->orWhere('device_model', 'like', '%' . $searchInput . '%')->paginate(5);
        } else {
            $searchInput = '';

            $phones = Phone::paginate(5);
        }


        return view('retailer.phones', compact('phones', 'searchInput'));
    }

    public function sellPhoneStore(Request $request)
    {
        dd($request);
        $phone = Phone::where('id',$request->phone_id)->first();
        if($phone){
            $phone->status = 'sold';
            if($phone->save()){
                $billDetails = new BillDetail();
                $billDetails->phone_id = $phone->id;
                $billDetails->customer_id = $phone->customer_id;
                $billDetails->user_id = $phone->user_id; 
                $billDetails->service_detail_id = 0;
                $billDetails->price = $request->sell_price;

                $billDetails->bill_for = 'mobile_sell';
                $billDetails->discount = $request->discount;
                $billDetails->total_price = $request->total_price;
                if($billDetails->save()){
                    $pdf = PDF::loadView('retailer.print_bill', compact('billDetails'));

                    // Download the PDF or display it in the browser
                    return $pdf->stream('receipt.pdf');
                }

            }
        }
        return redirect()->back()->with('success','Phone details saved successfully');
    }
}
