@extends('layouts.retailer')

@section('content')
    <div class="">
        <div class="form-wrap">
            <form id="customerForm" method="POST" action="{{ route('customers.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-gray-900 fw-bold">Basic information</h1>
                            <hr>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Customer Group</label>
                            <select id="customerGroupDropdown" name="customer_group" class="form-control" required>
                                <option disabled selected value>Select</option>
                                <option value="individual">individual</option>
                                <option value="company">Company</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label id="name-label" for="name">Organization</label>
                            <input type="text" name="organization" id="organization" placeholder="" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label id="name-label" for="name">First Name</label>
                            <input type="text" name="first_name" id="firstName" placeholder="" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" name="last_name" placeholder="" id="lastName" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label id="email-label" for="email">Email</label>
                            <div class="d-flex">
                                <input type="email" name="email" id="email" placeholder="someone@domain.com"
                                    class=" mr-1 form-control" required>
                                {{-- <button id="addEmailBtn" class="btn bg-gradient-primary text-white py-0 px-3 " onclick="addEmailInput()">+</button> --}}

                            </div>
                            {{-- <div class="mt-3 d-flex" id="inputFields"></div> --}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Phone</label>
                            <div class="d-flex">
                                <input type="text" name="phone" id="mobilePhone" class="form-control"
                                    placeholder="Phone Number">
                                {{-- <button class="btn bg-gradient-primary text-white py-0 px-3  ml-1">+</button> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>How did you hear about us?</label>
                            <select id="hearDropdown" name="how_did_you_hear_us" class="form-control" required>
                                <option disabled selected value>Select Option</option>
                                <option value="social">Social Media</option>
                                <option value="job">Full Time Job</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Network</label>
                            <select id="networkDropdown" name="network" class="form-control" required>
                                <option disabled selected value>Select Carrier</option>
                                <option value="vodafone">vodafone</option>
                                <option value="job">Full Time Job</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tax Class</label>
                            <select id="taxClassDropdown" name="tax_class" class="form-control" required>
                                <option disabled selected value>Select Option</option>
                                <option value="student">Student</option>
                                <option value="job">Full Time Job</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-gray-900 fw-bold">Address</h1>
                            <hr>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Street Address </label>
                            <input type="text" name="street_address"id="streetAddress" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">House / Apartment / Floor Number</label>
                            <input type="text" name="house_number" id="houseNumber" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">City</label>
                            <input type="text" name="city" id="city" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">State</label>
                            <input type="text" name="state" id="state" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">PostCode</label>
                            <input type="text" name="postcode" id="postcode" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Country</label>
                            <input type="text" name="country" id="country" class="form-control">
                        </div>
                    </div>

                </div>


                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-gray-900">Additional information</h1>
                            <hr>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Customer ID Type </label>
                            <input type="text" name="customer_id_type" id="customerIdType" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">ID Number</label>
                            <input type="text" name="id_number" id="idNumber" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Driving license</label>
                            <input type="text" name="driving_license" id="drivingLicense" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group Picture_2">
                            <label for="">Picture (2MB)</label>
                            <div class="d-flex">
                                <img id="" src="http://placehold.it/180" class="blah mr-1" alt="your image" />
                                <input type='file' name="image" class="form-control " onchange="readURL(this);" />
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-gray-900">Contact Person Details</h1>
                            <hr>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Contact Person</label>
                            <input type="text" name="contact_person" id="contactPerson" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" name="contact_person_phone" id="contactPersonPhone"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Relation</label>
                            <input type="text" name="relation" id="relation" class="form-control">
                        </div>
                    </div>

                </div>

                {{-- <div class="row">
                <div class="col-md-12">                            
                    <h3 class="text-gray-900">Custom Fields</h1> <hr>
                </div>
                <div class="col-md-12">
                    <div class="custom_field_box">
                        <p>You haven't created custom field yet.</p>
                        <button class="btn bg-gradient-primary text-white p-2"> Add Custom Field</button>
                    </div>
                </div>

            </div> --}}
                <div class="row">
                    <!-- <div class="col-md-6">
                        <div class="form-group">
                            <label>Would you recommend survey to a friend?</label>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" value="Definitely" name="customRadioInline1" class="custom-control-input" checked="">
                                <label class="custom-control-label" for="customRadioInline1">Definitely</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" value="Maybe" name="customRadioInline1" class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline2">Maybe</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline3" value="Not sure" name="customRadioInline1" class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline3">Not sure</label>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-md-12">
                        <h3 class="text-gray-900">Alert Settings</h1>
                            <hr>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" name="compliance_gdpr"
                                    value="yes" id="yes" checked="">
                                <label class="custom-control-label" for="yes">Compliance with GDPR</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" name="sms_notification"
                                    value="yes" id="yes" checked="">
                                <label class="custom-control-label" for="yes">SMS Notifications</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" name="email_notification"
                                    value="yes" id="yes" checked="">
                                <label class="custom-control-label" for="yes">Email Notifiactions</label>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- <div class="row d-none">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Leave Message</label>
                        <textarea  id="comments" class="form-control" name="comment" placeholder="Enter your comment here..."></textarea>
                    </div>
                </div>
            </div> --}}

                <div class="row">
                    <div class="col-md-12 text-right">
                        <button id="save" class="btn bg-gradient-primary text-white ">Save Customers</button>
                        <button id="saveAndAdd" class="btn bg-gray-800 text-white ">Save & add another Customer</button>
                        <button id="cancel" class="btn bg-gray-300 text-dark ">Cancel</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('save').addEventListener('click', function() {
                // Logic for the save button
                document.getElementById('customerForm').submit(); // Assuming 'myForm' is the form ID
            });

            document.getElementById('saveAndAdd').addEventListener('click', function() {
                // Logic for the save and add button
                document.getElementById('customerForm').submit(); // Assuming 'myForm' is the form ID
                // Add your redirect logic here
                window.location.href = window.location.href; // Redirect to the same page
            });

            document.getElementById('cancel').addEventListener('click', function() {
                // Logic for the cancel button
                document.getElementById('customerForm').reset(); // Assuming 'myForm' is the form ID
            });
        });

        var count = 1;
        function addEmailInput() {
            if (count <= 1) {
                var div = document.getElementById('inputFields');
                var input = document.createElement('input');
                input.type = 'email';
                input.name = 'email[]';
                input.placeholder = 'someone@domain.com';
                input.className = 'mr-1 form-control';
                div.appendChild(input);
                count++;
            } else {
                alert('Maximum limit reached');
            }
        }
    </script>
@endpush
