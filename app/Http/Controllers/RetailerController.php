<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\Ticket;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ServiceDetail;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerAdditionalInformation;

class RetailerController extends Controller
{
    //
    public function dashboard(){
        $total_customers = Customer::where('walk_in_customer',0)->count();
        $total_walkin = Customer::where('walk_in_customer',1)->count();
        $total_items = Item::count();

        return view('retailer.dashboard',compact('total_customers','total_walkin','total_items'));
    }


    public function customers(){
        return view('retailer.customer_create');
    }

    public function walkInByRetailer(){
        return view('retailer.walkIn_by_retailer');
    }


    public function serviceDetailStore(Request $request){
        // dd($request->all());
        $customer = Customer::where('id', $request->customer_id)->first();
        if($customer){
        $customer->customer_group = $request->customer_group;
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->how_did_you_hear_us = $request->how_did_you_hear_us;
        $customer->tax_class = $request->tax_class;
        $customer->save();
        $customerAddress = CustomerAddress::where('customer_id', $request->customer_id)->first();
        if($customerAddress){
            $customerAddress->location = $request->location;

        }else{
            $customerAddress =    new CustomerAddress();
            $customerAddress->customer_id = $customer->id;
            $customerAddress->location = $request->location;

        }
        $customerAddress->save();
        $customerAdditionalInformation = CustomerAdditionalInformation::where('customer_id', $request->customer_id)->first();
        if($customerAdditionalInformation){
            $customerAddress->location = $request->location;

        }else{
            $customerAdditionalInformation =    new customerAdditionalInformation();
            $customerAdditionalInformation->customer_id = $customer->id;

        $customerAdditionalInformation->driving_license = $request->driving_license;
            

        }
        $customerAdditionalInformation->save();


              // Service Details
              if ($request->customer_type == 'walk-in-by-retailer') {

                $serviceDetails = $request->input('service_details');
                if(sizeof($serviceDetails) > 0){
                    foreach($serviceDetails as $index => $detail){
                        $serviceDetail = new ServiceDetail();
                        $serviceDetail->user_id = Auth::user()->id;
                        $serviceDetail->customer_id = $customer->id;
                        $serviceDetail->repair_category = $detail['repair_category'];
                        $serviceDetail->device = $detail['device'];
                        $serviceDetail->device_issue = $detail['device_issue'];
                        $serviceDetail->imei_or_serial = $detail['imei_or_serial'];
                        $serviceDetail->repair_status = $detail['repair_status'];
                        $serviceDetail->repair_time = $detail['repair_time'];
                        $serviceDetail->assigned_to = 'Hassam Ali';
                        $serviceDetail->pickup_time = $detail['pickup_time'];
                        $serviceDetail->quantity = $detail['quantity'];
                        $serviceDetail->price = $detail['price'];
                        $serviceDetail->tax = $detail['tax'];
                        if ($serviceDetail->save()) {
                            $ticket = new Ticket();
                            $ticket->ticket_id = Str::random(10);
                            $ticket->customer_id = $customer->id;
                            $ticket->user_id = Auth::user()->id;
                            $ticket->service_detail_id = $serviceDetail->id;
                            $ticket->device = $serviceDetail->device;
                            $ticket->customer_name = $customer->first_name . ' ' . $customer->lastname;
                            $ticket->assigned_to = Auth::user()->id;
                            $ticket->ticket_status = 'pending';
                            $ticket->created_date = Carbon::now();
                            $ticket->due_date = $serviceDetail->pickup_time;
                            $ticket->select_criteria = 'select_criteria';
                            $ticket->save();
                        }
                        
                    }
                }
        
            }
        }
        return redirect()->back();
    }
}
