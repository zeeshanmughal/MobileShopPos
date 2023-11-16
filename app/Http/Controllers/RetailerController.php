<?php

namespace App\Http\Controllers;

use App\Models\BillDetail;
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
use App\Models\DeviceIssue;

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

       
        $customer = Customer::where('id', $request->customer_id)->first();
        if($customer){
      
        
            $dataCustomerAddress = [
                'location'=> $request->location,
                'street_address' => $request->street_address,
                'house_number' => $request->house_number,
                'city' => $request->city,
                'state' => $request->state,
                'postcode' => $request->postcode,
                'country' => $request->country,
            ];
            $conditionCustomer = [
                'customer_id'=>$customer->id
            ];
          
            
            $customerAddress =  CustomerAddress::updateOrCreate($conditionCustomer, $dataCustomerAddress);

            if($request->sms_notification == null){
                $sms_notification = 0;
            }else{
                $sms_notification = 1;
            }
            if($request->email_notification == null){
                $email_notification = 0;
            }else{
                $email_notification =1;

            }
            $dataCustomerAdditional = [
                'driving_license' => $request->driving_licese,
                'sms_notification'=>$sms_notification,
                'email_notification'=>$email_notification,

            ];
            
            $customerAdditional = CustomerAdditionalInformation::updateOrCreate($conditionCustomer, $dataCustomerAdditional);


              // Service Details
              if ($request->customer_type == 'walk-in-by-retailer') {

                $serviceDetails = $request->input('service_details');
                if(sizeof($serviceDetails) > 0){
                    foreach($serviceDetails as $index => $detail){
                        $deviceIssue = DeviceIssue::where('id', $detail['device_issue_id'])->first();
                        $serviceDetail = new ServiceDetail();
                        $serviceDetail->user_id = Auth::user()->id;
                        $serviceDetail->customer_id = $customer->id;
                        $serviceDetail->repair_category = $detail['repair_category'];
                        $serviceDetail->device = $detail['device'];
                        $serviceDetail->device_issue = $deviceIssue->issue_description;
                        $serviceDetail->imei_or_serial = $detail['imei_or_serial'];
                        $serviceDetail->repair_status = $detail['repair_status'];
                        $serviceDetail->repair_time = $detail['repair_time'];
                        $serviceDetail->assigned_to = 'Hassam Ali';
                        $serviceDetail->pickup_time = $detail['pickup_time'];
                        if($detail['quantity'] == null){
                            $quantity = 1;
                        }else{
                            $quantity = $detail['quantity'];

                        }
                        $serviceDetail->quantity = $quantity;
                        $serviceDetail->price = $detail['price'];
                        $serviceDetail->tax = $detail['tax'];
                        if ($serviceDetail->save()) {
                            $ticket = new Ticket();
                            $ticket->ticket_id = Str::random(10);
                            $ticket->customer_id = $customer->id;
                            $ticket->user_id = Auth::user()->id;
                            $ticket->service_detail_id = $serviceDetail->id;
                            $ticket->device = $serviceDetail->device;
                            $ticket->assigned_to = Auth::user()->id;
                            $ticket->ticket_status = 'pending';
                            $ticket->created_date = Carbon::now();
                            $ticket->due_date = $serviceDetail->pickup_time;
                            $ticket->select_criteria = 'select_criteria';
                            if($ticket->save()){
                                $billDetail = new BillDetail();
                                $billDetail->customer_id = $customer->id;
                                $billDetail->user_id = Auth::user()->id;
                                $billDetail->service_detail_id = $serviceDetail->id;
                                $billDetail->ticket_id = $ticket->id;
                                $billDetail->price = $serviceDetail->price;
                                $billDetail->quantity = $serviceDetail->quantity;
                                $billDetail->tax = $serviceDetail->tax;
                                $billDetail->discount= $request->bill_discount;
                                $billDetail->total_paid = $request->total_paid;
                                $billDetail->save();
                            }

                        

                        }
                        
                    }
                }
        
            }
        }
        return redirect()->back()->with('success', 'Record added successfully.');

    }
}
