@extends('layouts.retailer')
@push('styles')
    <style>
        .error-message {
            color: red;
            margin-top: 5px;
            /* Adjust as needed to control the spacing between the input and the error message */
        }
    </style>
@endpush
@section('content')
    <div class="">
        <div class="form-wrap">
            <form id="customerForm" method="POST" action="{{ route('customers.update',['customer'=>$customer->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-gray-900 fw-bold">Basic information</h1>
                            <hr>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Customer Group</label>
                            <select id="customerGroupDropdown" name="customer_group" class="form-control" >
                                <option disabled selected value>Select Customer Group</option>
                                <option @if($customer->customer_group == 'individual') selected @endif value="individual" >Individual</option>
                                <option @if($customer->customer_group == 'vender') selected @endif value="vender" >Vender</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label id="name-label" for="name">Organization</label>
                            <input type="text" name="organization" id="organization" placeholder="" class="form-control" value="{{ $customer->organization }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label id="name-label" for="name">First Name</label>
                            <input type="text" name="first_name" id="firstName" placeholder="" value="{{ $customer->first_name }}" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" name="last_name" placeholder=""  value="{{ $customer->last_name }}" id="lastName" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label id="email-label" for="email">Email</label>
                                <input type="email" name="email" id="email" placeholder="someone@domain.com"  value="{{ $customer->email }}"
                                    class="form-control" required>
                                {{-- <button id="addEmailBtn" class="btn bg-gradient-primary text-white py-0 px-3 " onclick="addEmailInput()">+</button> --}}

                            {{-- <div class="d-flex">
                                <input type="email" name="email" id="email" placeholder="someone@domain.com"
                                    class=" mr-1 form-control" required>
                                {{-- <button id="addEmailBtn" class="btn bg-gradient-primary text-white py-0 px-3 " onclick="addEmailInput()">+</button> --}}

                            {{-- </div>  --}}
                            {{-- <div class="mt-3 d-flex" id="inputFields"></div> --}}
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Country Code</label>
                            <input type="text" name="country_code" id="countryCode" class="form-control"  value="{{ $customer->country_code }}"
                                >
                       
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Phone Number</label>
                            <input type="text" name="phone" id="mobilePhone" class="form-control"  value="{{ $customer->phone }}"
                            placeholder="Phone Number" >
                         
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Network</label>
                            <select id="networkDropdown" name="network" class="form-control" >
                                <option disabled selected value>Select Carrier</option>
                                <option @if($customer->network == 'vodafone') selected @endif value="vodafone">Vodafone</option>
                                <option @if($customer->network == 'o2') selected @endif value="o2" >O2 </option>
                                <option @if($customer->network == 'bt_mobile') selected @endif value="bt_mobile">BT Mobile</option>
                                <option @if($customer->network == 'sky_mobile') selected @endif value="sky_mobile">Sky Mobile</option>

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
                            <input type="text" name="street_address"id="streetAddress" @if($customer->address) value="{{ $customer->address->street_address }}" @endif class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">House / Apartment / Floor Number</label>
                            <input type="text" name="house_number" id="houseNumber" class="form-control" @if($customer->address) value="{{ $customer->address->house_number }}" @endif>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">City</label>
                            <input type="text" name="city" id="city" class="form-control" @if($customer->address) value="{{ $customer->address->city }}" @endif>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">State</label>
                            <input type="text" name="state" id="state" class="form-control" @if($customer->address) value="{{ $customer->address->state }}" @endif>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">PostCode</label>
                            <input type="text" name="postcode" id="postcode" class="form-control" @if($customer->address) value="{{ $customer->address->postcode }}" @endif>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Country</label>
                            <input type="text" name="country" id="country" class="form-control" @if($customer->address) value="{{ $customer->address->country }}" @endif>
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
                            <input type="text" name="customer_id_type" id="customerIdType" class="form-control" @if($customer->additionalInformation) value="{{ $customer->additionalInformation->customer_id_type }}" @endif>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">ID Number</label>
                            <input type="text" name="id_number" id="idNumber" class="form-control" @if($customer->additionalInformation) value="{{ $customer->additionalInformation->id_number }}" @endif>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group Picture_2">
                            <label for="">Driving License or <small>( any id proof )</small></label>
                            <div class="d-flex">
                                @if($customer->driving_license)
                                <img id="drivingLicensePreview"  src="{{ asset($customer->driving_license) }}"   class="blah mr-1 previewImage"
                                alt="Id Proof Image" />
                                    @else
                                    <img id="drivingLicensePreview" src="https://placehold.it/180" class="blah mr-1 previewImage"
                                    alt="Id Proof Image" />
                                    @endif
                                <input type='file' name="driving_license" class="form-control" id="drivingLicense" accept="image/*" onchange="readURL(this, 'drivingLicensePreview');" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group Picture_2">
                            <label for="">Picture (2MB)</label>
                            <div class="d-flex">
                                @if($customer->image)
                                <img id="imagePreview"  src="{{ asset($customer->image) }}"   class="blah mr-1 previewImage"
                                    alt="Image Preview" />
                                    @else
                                    <img id="imagePreview" src="https://placehold.it/180" class="blah mr-1 previewImage"
                                    alt="Image Preview" />
                                    @endif
                                <input type='file' name="image" id="image" class="form-control" accept="image/*" onchange="readURL(this, 'imagePreview');" />
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
                            <input type="text" name="contact_person_name" id="contactPerson" class="form-control" @if($customer->additionalInformation) value="{{ $customer->additionalInformation->contact_person_name }}" @endif>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Country Code</label>
                            <input type="text" name="contact_person_country_code" id="contactPersonCountryCode"
                                class="form-control"  value="{{ $customer->additionalInformation->contact_person_country_code }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" name="contact_person_phone" id="contactPersonPhone"
                                class="form-control" @if($customer->additionalInformation) value="{{ $customer->additionalInformation->contact_person_phone }}" @endif>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Relation</label>
                            <input type="text" name="relation" id="relation" class="form-control" @if($customer->additionalInformation) value="{{ $customer->additionalInformation->relation }}" @endif>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">
                        <h3 class="text-gray-900">Alert Settings</h1>
                            <hr>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" name="compliance_gdpr"
                                    value="yes" id="compliance" @if($customer->additionalInformation && $customer->additionalInformation->compliance_gdpr == 1) checked @endif>
                                <label class="custom-control-label" for="compliance">Compliance with GDPR</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" name="sms_notification"
                                    value="yes" id="sms" @if($customer->additionalInformation && $customer->additionalInformation->sms_notification == 1) checked @endif>
                                <label class="custom-control-label" for="sms">SMS Notifications</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" name="email_notification"
                                    value="yes" id="emailNotification" @if($customer->additionalInformation && $customer->additionalInformation->email_notification == 1) checked @endif>
                                <label class="custom-control-label" for="emailNotification">Email Notifiactions</label>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12 text-right">
                        <button id="save" class="btn bg-gradient-primary text-white ">Update Customers</button>
                        {{-- <button id="saveAndAdd" class="btn bg-gray-800 text-white ">Save & add another Customer</button> --}}
                        {{-- <button id="cancel" class="btn bg-gray-300 text-dark ">Cancel</button> --}}
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('js')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var contactPersonCountryCodeInput = document.getElementById('contactPersonCountryCode');
            Inputmask(contactPersonCountryCode + ' 9999 999999').mask(document.getElementById('contactPersonPhone'));
            Inputmask({
                mask: '+999',
                placeholder: '',
                definitions: {
                    '9': {
                        validator: '[0-9]',
                        cardinality: 1
                    }
                }
            }).mask(contactPersonCountryCodeInput);

             // Attach an event listener to update the mask when the country code changes
             contactPersonCountryCodeInput.addEventListener('input', function() {
                Inputmask(' 9999 999999').mask(document.getElementById(
                    'contactPersonPhone'));
            });

            document.getElementById('save').addEventListener('click', function(event) {
                if (!validateForm()) {
                    event.preventDefault();
                }
            });

            document.getElementById('saveAndAdd').addEventListener('click', function(event) {
                if (!validateForm()) {
                    event.preventDefault();
                }
            });

            document.getElementById('cancel').addEventListener('click', function() {
                resetForm();
            });
        });

        function validateForm() {
            var form = document.getElementById('customerForm');
            var inputs = form.querySelectorAll('input[type="text"], input[type="email"], select');
            var errors = [];


            // Remove previous error messages
            removeErrorMessages();

            for (var i = 0; i < inputs.length; i++) {
                if (inputs[i].hasAttribute('required') && inputs[i].value.trim() === '') {
                    errors.push({
                        input: inputs[i],
                        'message': 'This Field is required'
                    })

                }

                            // Email validation
            if (inputs[i].type === 'email' && inputs[i].value.trim() !== '' && !validateEmail(inputs[i].value.trim())) {
                errors.push({ input: inputs[i], message: 'Please enter a valid email address.' });
            }

            // Phone validation
            if (inputs[i].type === 'tel' &&  inputs[i].value.trim() !== '' && !validatePhone(inputs[i].value.trim())) {
                errors.push({ input: inputs[i], message: 'Please enter a valid phone number.' });
            }
            }
            // Display all errors
            errors.forEach(function(error) {
                displayErrorMessage(error.input, error.message);
            });

            // Scroll to the first error message
            if (errors.length > 0) {
                errors[0].input.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }

            return errors.length === 0;

        }

        function validateEmail(email) {
        // Simple email validation regex
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function validatePhone(phone) {
        // Simple phone number validation regex
        var phoneRegex = /^[0-9]{15}$/;
        return phoneRegex.test(phone);
    }

        function removeErrorMessages() {
            var errorMessages = document.querySelectorAll('.error-message');
            errorMessages.forEach(function(errorMessage) {
                errorMessage.parentNode.removeChild(errorMessage);
            });
        }


        function displayErrorMessage(inputElement, message) {
            var errorMessage = document.createElement('div');
            errorMessage.className = 'error-message';
            errorMessage.textContent = message;
            inputElement.parentNode.appendChild(errorMessage);
        }


        function resetForm() {
            removeErrorMessages();
            document.getElementById('customerForm').reset();
        }

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
