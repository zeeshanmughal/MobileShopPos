<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Customer;
use App\Models\BillDetail;
use App\Models\DeviceIssue;
use App\Models\PaymentPlan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ServiceDetail;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Models\CustomerAdditionalInformation;

class RetailerController extends Controller
{
    //
    public function dashboard(){
        $total_customers = Customer::where('walk_in_customer',0)->count();
        $total_walkin = Customer::where('walk_in_customer',1)->count();
        $total_items = Item::count();

        $paymentPlans = PaymentPlan::all();

        

        return view('retailer.dashboard',compact('total_customers','total_walkin','total_items'));
    }


    public function customers(){
        return view('retailer.customer_create');
    }
    
    public function home(){
        return view('retailer.home');
    }
    public function pos_data(){
        return view('retailer.pos_data');
    }
    public function buy_sell(){
        return view('retailer.buy_sell');
    }
    public function buy_trade(){
        return view('retailer.buy_trade');
    }
    public function customers_detail(){
        return view('retailer.customers_detail');
    }
    public function appointments(){
        return view('retailer.appointments');
    }
    public function supplier(){
        return view('retailer.supplier');
    }
    public function new_supplier(){
        return view('retailer.new_supplier');
    }
    public function transactions(){
        return view('retailer.transactions');
    }
    public function category(){
        return view('retailer.category');
    }
    public function product(){
        return view('retailer.product');
    }
    public function new_product(){
        return view('retailer.new_product');
    }
    public function edit_product(){
        return view('retailer.edit_product');
    }
    public function product_detail(){
        return view('retailer.product_detail');
    }
    public function low_stock(){
        return view('retailer.low_stock');
    }
    public function pending_return(){
        return view('retailer.pending_return');
    }
    public function sale_list(){
        return view('retailer.sale_list');
    }
    public function notifications(){
        return view('retailer.notifications');
    }
    public function notes(){
        return view('retailer.notes');
    }
    // public function notifications(){
    //     return view('retailer.notifications');
    // }
    // 
    
    
    
   
    public function walkInByRetailer(){
        $deviceIssues = DeviceIssue::all();
        $inventoryItems = Item::all();

        return view('retailer.walkIn_by_retailer',compact('deviceIssues','inventoryItems'));
    }


    public function serviceDetailStore(Request $request){

        $customer = Customer::where('id', $request->customer_id)->first();
        if($customer){

            if ($request->hasFile('driving_license')) {
                $drivingLicenseFilePath = saveImage($request->file('driving_license'), 'customer_identity_images');
                if ($customer->driving_license) {
                    $previousLicenseFile = $customer->driving_license;
                    if(File::exists($previousLicenseFile)){
                        File::delete($previousLicenseFile);
                    }
                  
                }
            } elseif ($customer->driving_license) {
                $drivingLicenseFilePath = $customer->driving_license;
            } else {
                $drivingLicenseFilePath = null;
            }

            $dataCustomer = [
                'first_name' =>$request->first_name,
                'last_name' =>$request->last_name,
                'email' =>$request->email,
                'country_code' =>$request->country_code,
                'phone' =>$request->phone,
                'driving_license' => $drivingLicenseFilePath,
            ];

              $conditionCustomer = [
                'id'=>$customer->id
            ];
            $customer =  Customer::updateOrCreate($conditionCustomer, $dataCustomer);
        
        
            $dataCustomerAddress = [
                'street_address' => $request->street_address,
                'house_number' => $request->house_number,
                'city' => $request->city,
                'state' => $request->state,
                'postcode' => $request->postcode,
                'country' => $request->country,
                'location'=> $request->location,

            ];
            $conditionCustomerAddress = [
                'customer_id'=>$customer->id
            ];
          
            
            $customerAddress =  CustomerAddress::updateOrCreate($conditionCustomerAddress, $dataCustomerAddress);

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
                'driving_license' => $drivingLicenseFilePath,
                'sms_notification'=>$sms_notification,
                'email_notification'=>$email_notification,

            ];

              $conditionCustomerAdditional = [
                'customer_id'=>$customer->id
            ];
            
            $customerAdditional = CustomerAdditionalInformation::updateOrCreate($conditionCustomerAdditional, $dataCustomerAdditional);


              // Service Details
              if ($request->customer_type == 'walk-in-by-retailer') {

                $serviceDetails = $request->input('service_details');
                if(sizeof($serviceDetails) > 0){
                    foreach($serviceDetails as $index => $detail){
                        $deviceIssue = DeviceIssue::where('id', $detail['device_issue_id'])->first();
                        $serviceDetail = new ServiceDetail();
                        $serviceDetail->user_id = Auth::user()->id;
                        $serviceDetail->customer_id = $customer->id;
                        $serviceDetail->device_name = $detail['device_name'];
                        $serviceDetail->device_issue = $deviceIssue->id;
                        $serviceDetail->imei_or_serial = $detail['imei_or_serial'];
                        $serviceDetail->pickup_days = $detail['pickup_days'];
                        $serviceDetail->pickup_hours = $detail['pickup_hours'];
                        $serviceDetail->inventory_item_id = $detail['inventory_item_id'];
                        $serviceDetail->repair_status = $detail['repair_status'];
                        $serviceDetail->assigned_to = 'Hassam Ali';
                        if($detail['quantity'] == null){
                            $quantity = 1;
                        }else{
                            $quantity = $detail['quantity'];

                        }
                        $serviceDetail->quantity = $quantity;
                        $serviceDetail->price = $detail['price'];
                        if($detail['tax'] == null){
                            $tax = 0;
                        }else{
                            $tax = $detail['tax'];
                        }
                        $serviceDetail->tax = $tax;
                        if ($serviceDetail->save()) {
                            $ticket = new Ticket();
                            $ticket->ticket_id = Str::random(10);
                            $ticket->customer_id = $customer->id;
                            $ticket->user_id = Auth::user()->id;
                            $ticket->service_detail_id = $serviceDetail->id;
                            $ticket->device_name = $serviceDetail->device_name;
                            $ticket->assigned_to = Auth::user()->id;
                            $ticket->ticket_status = 'pending';
                            $ticket->ticket_purpose = 'repair';

                            $ticket->created_date = $request->created_on;

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
                            
                                $billDetail->tax = $tax;
                                if($request->bill_discount == null){
                                    $billDiscount = 0;
                                }else{
                                    $billDiscount = $request->bill_discount;
                                }
                                $billDetail->discount= $billDiscount;
                                if($request->total_paid == null){
                                    $totalPaid = 0;
                                }else{
                                    $totalPaid = $request->total_paid;
                                }
                                $billDetail->total_paid = $totalPaid;
                                $billDetail->paid_by = 'cash';
                                $billDetail->save();
                            }

                        

                        }
                        
                    }
                }
        
            }
        return redirect()->back()->with('success', 'Record added successfully.');

        }else{
        return redirect()->back()->with('error', 'Customer data not found.');

        }

    }


    public function showProfile(){
        $user = Auth::user();
        if($user){
            return view('retailer.profile',compact('user'));
        }else{
            return view('retailer.profile')->with('error','Failed to get user data');

        }

    }

    public function updateProfile(Request $request){

        // dd($request->all());
        $user = User::where('id',$request->user_id)->first();

        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone'=> 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'business_name'=>'required|string|max:255',
            'business_website' => 'nullable|url'
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile.show')->withErrors($validator)->withInput();
        }else{
            if($user){
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->phone = $request->phone;
                    $user->business_name = $request->business_name;
                    $user->business_website = $request->business_website;
                    if($user->update()){
                        return redirect()->route('profile.show')->with('success','User record updated successfully');
                    }else{
                        return redirect()->route('profile.show')->with('error','Failed to update user record');

                    }
            }else{
                return redirect()->route('profile.show')->with('error','User not found');

            }
        }

        
    }
}
