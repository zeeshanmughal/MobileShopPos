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
                            <select id="customerGroupDropdown" name="customer_group" class="form-control">
                                <option disabled selected value>Select Customer Group</option>
                                <option value="individual">Individual</option>
                                <option value="vender">Vender</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label id="name-label" for="name">Organization</label>
                            <input type="text" name="organization" id="organization" placeholder="" class="form-control">
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
                            <input type="email" name="email" id="email" placeholder="someone@domain.com"
                                class="form-control" required>

                                @error('email')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
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
                            <input type="text" name="country_code" id="countryCode" class="form-control"  value="{{ old('country_code') ?? '+44' }}"
                                required>
                       
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Phone Number</label>
                            <input type="text" name="phone" id="mobilePhone" class="form-control"
                                placeholder="Phone Number" value="{{ old('phone') }}" required>
                                @error('phone')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Network</label>
                            <select id="networkDropdown" name="network" class="form-control">
                                <option disabled selected value>Select Network</option>
                                <option value="vodafone">Vodafone</option>
                                <option value="o2">O2</option>
                                <option value="bt_mobile">BT Mobile</option>
                                <option value="sky_mobile">Sky Mobile</option>
                            </select>
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-gray-900 fw-bold">Address<small> (optional) </small></h3>
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
                            <input type="text" name="customer_id_type" id="customerIdType" class="form-control" placeholder="Social Security Number">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">ID Number</label>
                            <input type="text" name="id_number" id="idNumber" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group Picture_2">
                            <label for="">Driving License or <small>( any id proof )</small> </label>
                            <div class="d-flex">
                                <img id="drivingLicensePreview" src="https://placehold.it/180" class="blah mr-1 previewImage"
                                    alt="Id Proof Image" />
                                <input type='file' name="driving_license" class="form-control" id="drivingLicense"
                                    accept="image/*" onchange="readURL(this, 'drivingLicensePreview');" />
                            </div>
                        
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group Picture_2">
                            <label for="">Picture </label>
                            <div class="d-flex">
                                <img id="imagePreview" src="https://placehold.it/180" class="blah mr-1 previewImage"
                                alt="Image Preview"/>
                                <input type='file' name="image" class="form-control" id="image"
                                    accept="image/*" onchange="readURL(this, 'imagePreview');" />
                            </div>
                            {{-- <small class="text-muted">
                                Click to
                                <a href="#" onclick="openCamera()">Take a photo using the camera</a>
                                or
                                <a href="#" onclick="chooseFromLibrary()">Choose from library</a>.
                            </small>
                            <div id="cameraFeed" style="display:none;">
                                <video id="cameraPreview" width="100%" height="auto" autoplay playsinline></video>
                            </div> --}}
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
                            <input type="text" name="contact_person_name" id="contactPerson" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Country Code</label>
                            <input type="text" name="contact_person_country_code" id="contactPersonCountryCode"
                                class="form-control"  value="+44">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Phone Number</label>
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

                <div class="row">

                    <div class="col-md-12">
                        <h3 class="text-gray-900">Alert Settings</h1>
                            <hr>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" name="compliance_gdpr"
                                    value="yes" id="compliance">
                                <label class="custom-control-label" for="compliance">Compliance with GDPR</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" name="sms_notification"
                                    value="yes" id="sms">
                                <label class="custom-control-label" for="sms">SMS Notifications</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" name="email_notification"
                                    value="yes" id="emailNotification">
                                <label class="custom-control-label" for="emailNotification">Email Notifiactions</label>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12 text-right">
                        <button id="save" class="btn bg-gradient-primary text-white ">Save Customers</button>
                        {{-- <button id="saveAndAdd" class="btn bg-gray-800 text-white ">Save & add another Customer</button> --}}
                        {{-- <button id="cancel" class="btn bg-gray-300 text-dark ">Cancel</button> --}}
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <script>
        var fileInput = document.getElementById('image');
        var cameraFeed = document.getElementById('cameraFeed');
        var cameraPreview = document.getElementById('cameraPreview');

        function openCamera() {
            // Check if the browser supports getUserMedia
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({
                        video: true
                    })
                    .then(function(stream) {
                        // Success callback
                        // Use the stream to capture an image or display a live camera feed
                        // This example just stops the camera immediately
                        cameraFeed.style.display = 'block';
                        cameraPreview.srcObject = stream;
                        // stream.getTracks().forEach(track => track.stop());
                    })
                    .catch(function(error) {
                        console.error('Error accessing camera:', error);
                    });
            } else {
                alert('Your browser does not support accessing the camera.');
            }
        }

        function chooseFromLibrary() {
            console.log('Choosing from library');
            cameraFeed.style.display = 'none';
            fileInput.removeAttribute('capture');
            fileInput.click(); // Open file dialog to choose from library
        }

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
                    errors.push({
                        input: inputs[i],
                        message: 'Please enter a valid email address.'
                    });
                }

                // Phone validation
                if (inputs[i].type === 'tel' && inputs[i].value.trim() !== '' && !validatePhone(inputs[i].value.trim())) {
                    errors.push({
                        input: inputs[i],
                        message: 'Please enter a valid phone number.'
                    });
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
