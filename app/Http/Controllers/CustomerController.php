<?php

namespace App\Http\Controllers;

use Log;
use Exception;
use Carbon\Carbon;
use App\Models\Ticket;
use Twilio\Rest\Client;
use App\Models\Customer;
use App\Models\BillDetail;
use App\Models\DeviceIssue;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ServiceDetail;
use App\Models\CustomerAddress;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\CustomerAdditionalInformation;

class CustomerController extends Controller
{
    //

  
    public function index(Request $request)
    {
        $search = $request->input('search');

        $customers = Customer::when($search, function ($query) use ($search) {
            $query->where('first_name', 'like', '%' . $search . '%')
                  ->orWhere('last_name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
        })->paginate(10); // Adjust the number of items per page as needed
    
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
            'email' => [
                'required',
                'email',
                Rule::unique('customers')->whereNull('deleted_at'), // Ensures uniqueness in non-deleted records
            ],
            'phone' => [
                'required',
                Rule::unique('customers')->whereNull('deleted_at'), // Ensures uniqueness in non-deleted records
            ],
        ]);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        try {

            DB::beginTransaction();

            // Customer
            $customer = Customer::create([
                'uuid' => Str::uuid(),
                'slug' => createSlug($request->first_name . $request->last_name),
                'customer_group' => $request->customer_group,
                'organization' => $request->organization,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'country_code' => $request->country_code,
                'phone' => $request->phone,
                'network' => $request->network,
                'driving_license' => saveImage($request->file('driving_license'), 'customer_identity_images'),
                'image' => saveImage($request->file('image'), 'customer_images'),
                'tax_class' => $request->tax_class,
                'walk_in_customer' => $request->customer_type === 'walk-in' ? 1 : 0,
            ]);

            // Customer Address
            CustomerAddress::create([
                'customer_id' => $customer->id,
                'street_address' => $request->street_address,
                'house_number' => $request->house_number,
                'city' => $request->city,
                'state' => $request->state,
                'postcode' => $request->postcode,
                'country' => $request->country,
                'location' => $request->location,
            ]);

              // Customer Additional Information
        CustomerAdditionalInformation::create([
            'customer_id' => $customer->id,
            'customer_id_type' => $request->customer_id_type,
            'id_number' => $request->id_number,
            'driving_license' => $customer->driving_license,
            'image' => $customer->image,
            'contact_person_name' => $request->contact_person_name,
            'contact_person_country_code' => $request->contact_person_country_code,
            'contact_person_phone' => $request->contact_person_phone,
            'relation' => $request->relation,
            'compliance_gdpr' => $request->compliance_gdpr === 'yes' ? 1 : 0,
            'sms_notification' => $request->sms_notification === 'yes' ? 1 : 0,
            'email_notification' => $request->email_notification === 'yes' ? 1 : 0,
        ]);

        DB::commit();
        return redirect()->route('customers.index')->with('success', 'Customer saved successfully');
        } catch (\Exception $e) {
            DB::rollBack();

        Log::error($e);

        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Failed to save customer. Please try again.');
        }
    }

    
    

    public function edit($id)
    {
        $customer = Customer::find($id);
        $customerAddress = CustomerAddress::where('customer_id', $id)->first();
        $customerAdditionalInformation = CustomerAdditionalInformation::where('customer_id', $id)->first();

        return view('retailer.customer_edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->customer_group,'----',$request->network);


        $customer = Customer::find($id);
        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not found');
        } else {




            if ($request->hasFile('image')) {
                $imagePath = saveImage($request->file('image'), 'customer_images');
                if ($customer->image) {

                    $previousImage = $customer->image;

                    if (File::exists($previousImage)) {
                        File::delete($previousImage);
                    }
                }
            } else {
                // No new image uploaded, use the existing image path or set it to null if none
                $imagePath = $customer->image ?: null;
            }

            if ($request->hasFile('driving_license')) {
                $drivingLicenseFilePath = saveImage($request->file('driving_license'), 'customer_identity_images');
                if ($customer->driving_license) {
                    $previousLicenseFile = $customer->driving_license;
                    if (File::exists($previousLicenseFile)) {
                        File::delete($previousLicenseFile);
                    }
                }
            } else {
                $drivingLicenseFilePath = $customer->driving_license ?: null;
            }


            $customer->customer_group = $request->customer_group;
            $customer->organization = $request->organization;
            $customer->first_name = $request->first_name;
            $customer->last_name = $request->last_name;
            $customer->email = $request->email;
            $customer->country_code = $request->country_code;
            $customer->phone = $request->phone;
            $customer->network = $request->network;
            $customer->driving_license = $drivingLicenseFilePath;
            $customer->image = $imagePath;

            $customer->tax_class = $request->tax_class;

            if ($request->customer_type == 'walk-in') {

                $customer->walk_in_customer = 1;
            } else {
                $customer->walk_in_customer = 0;
            }
            $customer->save();

            $customerAddress = CustomerAddress::where('customer_id', $id)->first();
            if (!$customerAddress) {
                $customerAddress = new CustomerAddress();
            }
            $customerAddress->customer_id = $customer->id;
            $customerAddress->street_address = $request->street_address;
            $customerAddress->house_number = $request->house_number;
            $customerAddress->city = $request->city;
            $customerAddress->state = $request->state;
            $customerAddress->postcode = $request->postcode;
            $customerAddress->country = $request->country;
            $customerAddress->location = $request->location;
            $customerAddress->save();

            $customerAdditionalInformation = CustomerAdditionalInformation::where('customer_id', $id)->first();
            if (!$customerAdditionalInformation) {
                $customerAdditionalInformation = new CustomerAdditionalInformation();
            }
            $customerAdditionalInformation->customer_id = $customer->id;
            $customerAdditionalInformation->customer_id_type = $request->customer_id_type;
            $customerAdditionalInformation->id_number = $request->id_number;
            $customerAdditionalInformation->driving_license = $drivingLicenseFilePath;
            $customerAdditionalInformation->image = $imagePath;

            $customerAdditionalInformation->contact_person_name = $request->contact_person_name;
            $customerAdditionalInformation->contact_person_country_code = $request->contact_person_country_code;
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
        }
        return redirect()->route('customers.index')->with('success',  'Customer updated.');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        if (!$customer) {
            return redirect()->route('customers.index')->with('error', 'Customer not found');
        } else {
            $customer->address()->delete();
            $customer->additionalInformation()->delete();
            $customer->serviceDetails()->delete();
            $customer->tickets()->delete();

            if ($customer->delete()) {
                return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
            } else {
                return redirect()->route('customers.index')->with('error', 'Failed to delete customer.');
            }
        }
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

    public function getDropdownCustomers()
    {
        $results = Customer::take(5)->get();
        return response()->json($results);
    }

    public function fetchCustomerData(Request $request)
    {
        $customerId = $request->get('customerId');

        $customer = Customer::find($customerId);
        if (!$customer) {
            return response()->json([]);
        } else {
            $customerAddress = $customer->address;
            $customerAdditionalInformation = $customer->additionalInformation;
            $customer->address = $customerAddress;
            $customer->info = $customerAdditionalInformation;
        }

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

    public function destroy_issue($deviceIssue)
    {
        $deviceIssue = DeviceIssue::find($deviceIssue);
        $deviceIssue->delete();
        return redirect()->route('device_issues')->with('success', 'Device Issue deleted successfully.');
    }

    public function walkInServiceDetailStore(Request $request)
    {
        // dd($request->all());
        $ticketData = [];
        $validator = Validator::make($request->all(), [
            // Add validation rules for each field
        ]);

        if ($validator->fails()) {
            // Handle the validation errors
        } else {

            // Customer

            if ($request->hasFile('driving_license')) {
                $drivingLicenseFilePath = saveImage($request->file('driving_license'), 'customer_identity_images');
            } else {
                $drivingLicenseFilePath = null;
            }

            $customer = new Customer();
            $customer->uuid = Str::uuid();
            $customer->slug = createSlug($request->first_name . $request->last_name);
            // $customer->customer_group = $request->customer_group;
            $customer->first_name = $request->first_name;
            $customer->last_name = $request->last_name;
            $customer->email = $request->email;
            $customer->country_code = $request->country_code;
            $customer->phone = $request->phone;
            $customer->driving_license = $drivingLicenseFilePath;


            if ($request->customer_type == 'walk-in-customer') {

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


            if ($customerAdditionalInformation->save()) {
                $serviceDetails = $request->input('service_details');
                if (sizeof($serviceDetails) > 0) {
                    foreach ($serviceDetails as $index => $detail) {
                        $deviceIssue = DeviceIssue::where('id', $detail['device_issue_id'])->first();
                        $serviceDetail = new ServiceDetail();
                        $serviceDetail->customer_id = $customer->id;
                        $serviceDetail->device_name = $detail['device_name'];
                        $serviceDetail->device_issue = $deviceIssue->id;
                        $serviceDetail->imei_or_serial = $detail['imei_or_serial'];
                        $serviceDetail->repair_status = 'pending';
                        $serviceDetail->assigned_to = 'Hassam Ali';

                        if ($detail['quantity'] == null) {
                            $quantity = 1;
                        } else {
                            $quantity = $detail['quantity'];
                        }
                        $serviceDetail->quantity = $quantity;

                        if ($serviceDetail->save()) {
                            $ticket = new Ticket();
                            $ticket->ticket_id = Str::random(10);
                            $ticket->customer_id = $customer->id;
                            // $ticket->user_id = Auth::user()->id;
                            $ticket->service_detail_id = $serviceDetail->id;
                            $ticket->device_name = $serviceDetail->device_name;
                            $ticket->ticket_status = 'pending';
                            $ticket->ticket_purpose = 'repair';
                            $ticket->created_date = Carbon::now();
                            $ticket->select_criteria = 'select_criteria';
                            if ($ticket->save()) {
                                $billDetail = new BillDetail();
                                $billDetail->customer_id = $customer->id;
                                $billDetail->service_detail_id = $serviceDetail->id;
                                $billDetail->ticket_id = $ticket->id;
                                $billDetail->quantity = $serviceDetail->quantity;
                                $billDetail->save();

                                $ticketData[] = [
                                    'ticket_id' => $ticket->ticket_id,
                                    'first_name' => $customer->first_name,
                                    'last_name' => $customer->last_name,
                                    'email' => $customer->email,
                                    'phone' => $customer->phone,
                                    'device' => $serviceDetail->device,
                                    'device_issue' => $serviceDetail->device_issue,
                                    'status' => 'pending'
                                ];
                            }
                        }
                    }
                    return redirect()->route('getWalkinCustomerTicketView', ['customer_id' => $customer->id])->with([
                        'message' => 'Successfully Submitted',
                        'ticketData' => $ticketData,
                    ]);
                }
            }





            return redirect()->back();
        }
    }
    public function getTicketView($customer_id)
    {
        $ticketData = [];
        if ($customer_id) {
            $customer = Customer::where('id', $customer_id)->where('walk_in_customer', 1)->first();

            if ($customer) {
                $serviceDetails = ServiceDetail::where('customer_id', $customer->id)
                    ->where('repair_status', 'pending')->get();
                if ($serviceDetails && sizeof($serviceDetails) > 0) {
                    foreach ($serviceDetails as $service) {
                        $ticket = Ticket::where('service_detail_id', $service->id)->first();
                        $billDetail = BillDetail::where('customer_id', $customer->id)->where('service_detail_id', $service->id)
                            ->where('ticket_id', $ticket->id)->first();

                        $ticketData[] = [
                            'ticket_id' => $ticket->ticket_id,
                            'first_name' => $customer->first_name,
                            'last_name' => $customer->last_name,
                            'email' => $customer->email,
                            'phone' => $customer->phone,
                            'device' => $service->device,
                            'device_issue' => $service->device_issue,
                            'status' => 'pending'
                        ];
                    }
                }
            }
        }
        return view('user.get_ticket', ['ticketData' => $ticketData]);
    }

    public function sendSms()
    {
        $receiverNumber = '+923084544542'; // Replace with the recipient's phone number
        $message = 'Hello'; // Replace with your desired message

        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $fromNumber = env('TWILIO_FROM');


        try {
            $client = new Client($sid, $token);
            $client->messages->create($receiverNumber, [
                'from' => $fromNumber,
                'body' => $message
            ]);

            return 'SMS Sent Successfully.';
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
