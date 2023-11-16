<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ticket;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ServiceDetail;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\CustomerAdditionalInformation;
use App\Models\DeviceIssue;

class CustomerController extends Controller
{
    //

    public function index()
    {
        $customers = Customer::all();


        return view('retailer.customers', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            // Add validation rules for each field
        ]);

        if ($validator->fails()) {
            // Handle the validation errors
        } else {

            // Customer

            $customer = new Customer();
            $customer->uuid = Str::uuid();
            $customer->slug = createSlug($request->first_name . $request->last_name);
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
            if ($request->image) {
                $imagePath = saveImage($request->image, 'customer_images');
                $customerAdditionalInformation->image = $imagePath;
                // 

            }
            $customerAdditionalInformation->contact_person_detail = $request->contact_person;
            $customerAdditionalInformation->contact_person_phone = $request->contact_person_phone;
            $customerAdditionalInformation->relation = $request->relation;
            if ($request->compliance_gdpr == 'yes') {
                $customerAdditionalInformation->compliance_gdpr = 1;
            } else {
                $customerAdditionalInformation->compliance_gdpr = 0;
            }
            if ($request->sms_notification == 'yes') {
                $customerAdditionalInformation->sms_notification = 1;
            } else {
                $customerAdditionalInformation->sms_notification = 0;
            }
            if ($request->email_notification == 'yes') {
                $customerAdditionalInformation->email_notification = 1;
            } else {
                $customerAdditionalInformation->email_notification = 0;
            }
            $customerAdditionalInformation->save();





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
        $customerAddress->location = $request->location;

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

    public function fetchCustomerData(Request $request)
    {
        $customerId = $request->get('customerId');

        $customer = Customer::find($customerId);
        return response()->json($customer);
    }


    public function generateQRCode()
    {
        $url = route('walkInByCustomer.create');
        return view('user.qr_code', compact('url'));
    }

    public function getWalkinCustomerForm()
    {
        return view('user.walkin_customer');
    }

    public function addNewIssue(Request $request)
    {
        $request->validate([
            'issueDescription' => 'required|string|max:255',
        ]);
        $issue_description = $request->issueDescription;
        $is_exist = DeviceIssue::where('issue_description', $issue_description)->first();
        if (!$is_exist) {
            $deviceIssue = new DeviceIssue;
            $deviceIssue->issue_description = $issue_description;
            if ($deviceIssue->save()) {
                // Fetch the updated list of issues
                $issues = DeviceIssue::pluck('issue_description')->toArray();
                return response()->json(['status' => 'success', 'message' => 'Device issue added successfully', 'issues' => $issues]);
            } else {
                $issues = DeviceIssue::pluck('issue_description')->toArray();
                return response()->json(['status' => 'error', 'message' => 'Failed to Add this issue', 'issues' => $issues]);
            }
        } else {
            $issues = DeviceIssue::pluck('issue_description')->toArray();

            return response()->json(['status' => 'error', 'message' => 'Failed to Add this issue', 'issues' => $issues]);
        }
    }

 

    public function searchDeviceIssues(Request $request)
    {
        $searchResults = DeviceIssue::where('issue_description', 'like', '%' . $request->term . '%')->get();

        return response()->json($searchResults);
    }


    public function getDeviceIssues()
    {
        $deviceIssues = DeviceIssue::all();
        return view('retailer.device_issues', compact('deviceIssues'));
    }

    public function storeOrUpdate(Request $request)
    {
        $id = $request->input('issue_id');
        $issueDescription = $request->input('issueDescription');
            
        // Check if ID is present to determine if it's an update
        if ($id) {
            // Update operation
            $issue = DeviceIssue::find($id);
            if ($issue) {
                $issue->issue_description = $issueDescription;
                $issue->save();
                return redirect()->route('device_issues')->with('success', 'Issue updated successfully.');
            } else {
                return redirect()->route('device_issues')->with('error', 'Issue not found.');
            }
        } else {
            // Store operation
            $newIssue = new DeviceIssue();
            $newIssue->issue_description = $issueDescription;
            $newIssue->save();
            return redirect()->route('device_issues')->with('success', 'Issue added successfully.');
        }
    }

    public function destroy_issue( $deviceIssue){
       $deviceIssue = DeviceIssue::find($deviceIssue);
        $deviceIssue->delete();
        return redirect()->route('device_issues')->with('success', 'Device Issue deleted successfully.');

    }
}
