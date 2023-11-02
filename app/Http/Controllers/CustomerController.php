<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ticket;
use App\Models\Customer;
use Endroid\QrCode\QrCode;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ServiceDetail;
use App\Models\CustomerAddress;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\CustomerAdditionalInformation;

class CustomerController extends Controller
{
    //

    public function index(){
        $customers = Customer::all();
      

        return view('retailer.customers', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            // Add validation rules for each field
        ]);

        if ($validator->fails()) {
            // Handle the validation errors
        } else {

            // Customer

            $customer = new Customer();
            $customer->uuid = Str::uuid();
            $customer->slug = createSlug($request->first_name.$request->last_name);
            $customer->customer_group = $request->customer_group;
            $customer->organization = $request->organization;
            $customer->first_name = $request->first_name;
            $customer->last_name = $request->last_name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->how_did_you_hear_us = $request->how_did_you_hear_us;
            $customer->network = $request->network;
            $customer->tax_class = $request->tax_class;

            if ($request->customer_type == 'walk-in') {

                $customer->walk_in_customer = 1;
            }
            $customer->save();

            // Customer Address
            $customerAddress = new CustomerAddress();
            $customerAddress->customer_id = $customer->id;
            $customerAddress->street_address = $request->street_address;
            $customerAddress->house_number = $request->house_number;
            $customerAddress->city = $request->city;
            $customerAddress->state = $request->state;
            $customerAddress->postcode = $request->postcode;
            $customerAddress->country = $request->country;
            $customerAddress->location = $request->location;
            $customerAddress->save();

            // Customer Additional Information
            $customerAdditionalInformation = new CustomerAdditionalInformation();
            $customerAdditionalInformation->customer_id = $customer->id;
            $customerAdditionalInformation->customer_id_type = $request->customer_id_type;
            $customerAdditionalInformation->id_number = $request->id_number;
            $customerAdditionalInformation->driving_license = $request->driving_license;
            $imagePath = saveImage($request->image, 'customer_images');
            $customerAdditionalInformation->image = $imagePath;
            $customerAdditionalInformation->contact_person_detail = $request->contact_person;
            $customerAdditionalInformation->contact_person_phone = $request->contact_person_phone;
            $customerAdditionalInformation->relation = $request->relation;
            if($request->compliance_gdpr == 'yes'){
                $customerAdditionalInformation->compliance_gdpr = 1;

            }else{
                $customerAdditionalInformation->compliance_gdpr = 0;
            }
            if($request->sms_notification == 'yes'){
                $customerAdditionalInformation->sms_notification = 1;

            }else{
                $customerAdditionalInformation->sms_notification = 0;
            }
            if($request->email_notification == 'yes'){
                $customerAdditionalInformation->email_notification = 1;

            }else{
                $customerAdditionalInformation->email_notification = 0;
            }
            $customerAdditionalInformation->save();

            // Service Details
            if ($request->customer_type == 'walk-in') {

                $serviceDetail = new ServiceDetail();
                $serviceDetail->user_id = Auth::user()->uuid;
                $serviceDetail->customer_id = $customer->id;
                $serviceDetail->repair_category = $request->repair_category;
                $serviceDetail->device = $request->device;
                $serviceDetail->device_issue = $request->device_issue;
                $serviceDetail->imei_or_serial = $request->imei_or_serial;
                $serviceDetail->repair_status = $request->repair_status;
                $serviceDetail->repair_time = $request->repair_time;
                $serviceDetail->assigned_to = $request->assigned_to;
                $serviceDetail->pickup_time = $request->pickup_time;
                $serviceDetail->quantity = $request->quantity;
                $serviceDetail->price = $request->price;
                $serviceDetail->tax = $request->tax;
                if ($serviceDetail->save()) {
                    $ticket = new Ticket();
                    $ticket->ticket_id = Str::random(7);
                    $ticket->device = $serviceDetail->device;
                    $ticket->customer_name = $customer->first_name . ' ' . $customer->lastname;
                    $ticket->assigned_to = Auth::user()->uuid;
                    $ticket->ticket_status = $request->ticket_status;
                    $ticket->created_date = Carbon::now();
                    $ticket->due_date = $serviceDetail->pickup_time;
                    $ticket->select_criteria = $request->select_criteria;
                }
            }



            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        $customerAddress = CustomerAddress::where('customer_id', $id)->first();
        $customerAdditionalInformation = CustomerAdditionalInformation::where('customer_id', $id)->first();

        // ... return the view with the retrieved data for editing
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->customer_group = $request->customer_group;
        $customer->organization = $request->organization;
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->how_did_you_hear_us = $request->how_did_you_hear_us;
        $customer->network = $request->network;
        $customer->tax_class = $request->tax_class;
        $customer->save();

        $customerAddress = CustomerAddress::where('customer_id', $id)->first();
        $customerAddress->street_address = $request->street_address;
        $customerAddress->house_number = $request->house_number;
        $customerAddress->city = $request->city;
        $customerAddress->state = $request->state;
        $customerAddress->postcode = $request->postcode;
        $customerAddress->country = $request->country;
        $customerAddress->save();

        $customerAdditionalInformation = CustomerAdditionalInformation::where('customer_id', $id)->first();
        $customerAdditionalInformation->customer_id_type = $request->customer_id_type;
        $customerAdditionalInformation->id_number = $request->id_number;
        $customerAdditionalInformation->driving_license = $request->driving_license;
        $customerAdditionalInformation->picture = $request->picture;
        $customerAdditionalInformation->contact_person_detail = $request->contact_person_detail;
        $customerAdditionalInformation->contact_person_phone = $request->contact_person_phone;
        $customerAdditionalInformation->relation = $request->relation;
        $customerAdditionalInformation->compliance_gdpr = $request->compliance_gdpr;
        $customerAdditionalInformation->sms_notification = $request->sms_notification;
        $customerAdditionalInformation->email_notification = $request->email_notification;
        $customerAdditionalInformation->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        Customer::destroy($id);
        CustomerAddress::where('customer_id', $id)->delete();
        CustomerAdditionalInformation::where('customer_id', $id)->delete();

        return redirect()->back();
    }

    public function searchCustomer(Request $request)
    {
        $searchTerm = $request->search;
        if ($searchTerm) {
            $results = Customer::where('first_name', 'like', '%' . $searchTerm . '%')
                                ->orWhere('last_name', 'like', '%' . $searchTerm . '%')->get();

            return response()->json($results);
        }

        return response()->json([]);
    }


    public function generateQRCode()
    {
        $base_path = base_path();
        
        $url = 'https://google.com.pk'; // Replace with your specific URL containing the form

        // Create a QR code instance
        $qrCode = new QrCode($url);

        // Set any additional parameters if needed
        // For example, $qrCode->setSize(300);

        // Create a PNG writer
        $writer = new PngWriter();

        // Generate the QR code image
        $result = $writer->write($qrCode);

        // Set the response headers
        header('Content-Type: image/png');

        // Output the QR code image
        echo $result->getString();
    }

    public function getWalkinCustomerForm(){
        return view ('user.walkin_customer');
    }
}
