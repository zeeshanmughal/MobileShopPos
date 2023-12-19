@extends('layouts.retailer')
@push('styles')
    <style>
        .search-results {
            position: absolute;
            top: 38px;
            /* Adjust this value based on your layout */
            z-index: 1000;
            background-color: #fff;
            border: 1px solid #ddd;
            width: 67%;
            max-height: 200px;
            overflow-y: auto;
        }


        .search-item {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
        }

        .search-item:hover {
            background: #f9f9f9;
        }

        #searchResults {
            max-height: 200px;
            /* Adjust the height according to your design */
            overflow-y: auto;
            position: absolute;
            z-index: 1;
            font-size: 14px;
            list-style-type: none;
            padding: 0;
        }

        .search-result-item {
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
    </style>
@endpush
@section('content')
@include('retailer.partials.response_message')

    <form id="buyPhoneForm" class="toggle_profile" method="POST" action="{{ route('phone_buy.store') }}"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="customer_type" value="walk-in-by-retailer">
        <input type="hidden" name="customer_id" id="customerId" value="{{ old('customer_id') }}">
        <div class="row ">
            <div class="col-md-6 ">
                <div class="accordionExample1 p-3 form-wrap">
                    <div class="" id="headingOne">
                        <h4 class="mb-0 row align-items-center">
                            <div class="col-md-6" aria-expanded="true">
                                {{-- <img src="{{ retailer_asset('img/icon.png') }}">  --}}
                                <span class="text-gray-900 pb-0 fw-bold">Customer Details</span>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-0 d-flex" id="searchContainer">
                                    <input type="text" name="search_customer" id="searchCustomerInput"
                                        class="form-control mr-1" placeholder="Search Customer" autocomplete="off">
                                    <div id="searchResults" class="search-results"></div>

                                    <button class="btn bg-gradient-primary text-white py-0 px-1 "
                                        onclick="window.location.href = '{{ route('customer.create') }}'">New</button>
                                </div>
                            </div>
                        </h4>
                    </div>
                    <div id="" class=" show pt-4" aria-labelledby="headingOne" data-parent=".accordionExample1">
                        <div class="row">


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label id="name-label" for="name">First Name</label>
                                    <input type="text" name="first_name" id="customerFirstName" placeholder=""
                                        class="form-control" value="{{ old('first_name') }}">
                                    @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Last Name</label>
                                    <input type="text" name="last_name" placeholder="" id="customerLastName"
                                        class="form-control" value="{{ old('last_name') }}">
                                    @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>



                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Country Code</label>
                                    <input type="text" name="country_code" id="countryCode"
                                        class="form-control makeDisable" value="{{ old('country_code') }}">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Phone Number</label>
                                    <div class="d-flex">
                                        <input type="text" id="mobilePhone" class="form-control"
                                            placeholder="Phone Number" name="phone" value="{{ old('phone') }}">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        {{-- <button class="btn bg-gradient-primary text-white py-0 px-3  ml-1">+</button> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label id="email-label" for="email">Email</label>
                                    <div class="d-flex">
                                        <input type="email" name="email" id="email" placeholder=""
                                            class="mr-1 form-control" value="{{ old('email') }}">
                                        {{-- <button class="btn bg-gradient-primary text-white py-0 px-3 ">+</button> --}}
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Customer Group</label>
                                    <input type="text" name="customer_group" id="customerGroup" placeholder=""
                                        class="form-control" value="{{ old('customer_group') }}">
                                    @error('customer_group')
                                       <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="col-md-7">
                                <div class="form-group Picture_2">
                                    <label for="">Driving License or <small>(any id proof)</small> </label>
                                    <div class="d-flex">
                                      
                                        <img id="drivingLicensePreview" src="https://placehold.it/180"
                                            class="blah mr-1 previewImage" alt="Id Proof Image" />
                                         
                                        <input type='file' name="driving_license" class="form-control"
                                            id="drivingLicense" accept="image/*"
                                            onchange="readURL(this, 'drivingLicensePreview');" />
                                        
                                    </div>
                                    <span class="text-danger" id="drivingLicenseError"></span>
                                    @error('driving_license')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <strong>Notifications</strong>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" class="custom-control-input"
                                                    name="sms_notification" id="smsNotificationCheckbox"
                                                    {{ old('sms_notification') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="smsNotificationCheckbox">SMS
                                                    Notifications</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" class="custom-control-input"
                                                    name="email_notification" id="emailNotificationCheckbox"
                                                    {{ old('email_notification') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="emailNotificationCheckbox">Email
                                                    Notifications</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 pt-4">
                                <a href="#" class="styled-link" onclick="showAddressFields(event)"><u>
                                        <strong> Add Address <small id="optionalText"> (optional)</small></strong>
                                    </u></a>
                            </div>
                        </div>
                        <div class="container mt-3">
                            <div class="row d-none" id="addressSection">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Street Address </label>
                                        <input type="text" name="street_address"id="streetAddress"
                                            class="form-control" value="{{ old('street_address') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">House/Aprt/Floor No#</label>
                                        <input type="text" name="house_number" id="houseNumber" class="form-control"
                                            value="{{ old('house_number') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">City</label>
                                        <input type="text" name="city" id="city" class="form-control"
                                            value="{{ old('city') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">State</label>
                                        <input type="text" name="state" id="state" class="form-control"
                                            value="{{ old('state') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">PostCode</label>
                                        <input type="text" name="postcode" id="postcode" class="form-control"
                                            value="{{ old('postcode') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Country</label>
                                        <input type="text" name="country" id="country" class="form-control"
                                            value="{{ old('country') }}">
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- ...... -->
            <div class="col-md-6">
                <div class="accordionExample2 p-3 form-wrap">
                    <div class="" id="heading2">
                        <h4 class="mb-0 align-items-center">
                            <div data-toggle="collapse" data-target="#collapse2" aria-expanded="true"
                                aria-controls="collapseOne">
                                {{-- <img src="{{ retailer_asset('img/icon.png') }}">  --}}
                                <span class="text-gray-900 pb-0 fw-bold">Phone Details</span>
                            </div>
                        </h4>
                    </div>
                    <div id="collapse2" class="collapse show pt-4" aria-labelledby="heading2"
                        data-parent=".accordionExample2">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Device Model</label>
                                    <input type="text" name="device_model" id="deviceModel" class="form-control"
                                        value="{{ old('device_model') }}">
                                    @error('device_model')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Device Brand</label>
                                    <input type="text" name="device_brand" id="deviceBrand" class="form-control"
                                        value="{{ old('device_brand') }}">
                                    @error('device_brand')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Condition</label>
                                    <select name="condition" class="form-control">
                                        <option selected disabled>Choose Condition</option>
                                        <option value="brand_new" {{ old('condition') == 'brand_new' ? 'selected' : '' }}>Brand New</option>
                                        <option value="a_grade" {{ old('condition') == 'a_grade' ? 'selected' : '' }}>A grade</option>
                                        <option value="b_grade" {{ old('condition') == 'b_grade' ? 'selected' : '' }}>B grade</option>
                                        <option value="c_grade" {{ old('condition') == 'c_grade' ? 'selected' : '' }}>C grade</option>
                                        <option value="not_working" {{ old('condition') == 'not_working' ? 'selected' : '' }}>Not Working</option>

                                    </select>
                                    @error('condition')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Imei</label>
                                    <input type="text" name="imei" id="imei" class="form-control"
                                        value="{{ old('imei') }}">
                                    @error('imei')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Mobile Pin</label>
                                    <input type="text" name="mobile_pin" id="mobilePin" class="form-control"
                                        value="{{ old('mobile_pin') }}">
                                    @error('mobile_pin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Buying Price</label>
                                    <input type="text" name="buying_price" id="buyingPrice" class="form-control"
                                        value="{{ old('buying_price') }}">
                                    @error('buying_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Selling Price</label>
                                    <input type="text" name="selling_price" id="sellingPrice" class="form-control"
                                        value="{{ old('selling_price') }}">
                                    @error('selling_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="d-flex justify-content-end mt-4 mr-4">
                            <button type="button" id="printLabelBtn" class="btn btn-primary btn-sm" disabled>Print
                                Label</button>
                        </div>
                    </div>
                </div>
            </div>



        </div>


        <div class="row mt-3">
            <div class="col-md-12 text-right">
                <button type="button" id="saveWalkInCustomer" class="btn bg-gradient-primary text-white">Save Phone
                    Details</button>
            </div>
        </div>

    </form>
@endsection

@push('js')
    <script>
        $isValid = true;
        $(document).ready(function() {
            checkFormFields();

        });
        $(document).on('click', '#saveWalkInCustomer', function(event) {
            event.preventDefault();

            if($isValid){
                const form = document.getElementById('buyPhoneForm');
            form.submit();

            }else {
                document.documentElement.scrollTop = 0;
            }
            
        });
        $(document).ready(function() {
            // Assuming 'response.driving_license' contains the file URL or base64 data
            $('#drivingLicense').change(function() {
                var file = this.files[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview').html('<img src="' + e.target.result +
                        '" style="max-width: 200px; max-height: 200px;" alt="Driving License Preview">'
                        );
                }

                reader.readAsDataURL(file);
            });
        });
        $(document).ready(function() {

            $('#searchCustomerInput').on('click', function() {
                $.ajax({
                    url: '/get-customers',
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#searchResults').empty();
                        let resultsContainer = $('#searchResults');
                        $.each(response, function(index, customer) {
                            resultsContainer.append(
                                '<li class="search-result-item" data-customer-id="' +
                                customer.id + '">' + customer.first_name + ' ' + (
                                    customer.last_name ? customer.last_name : '') +
                                (customer
                                    .email ? ' - ' + customer.email : '') + '</li>'
                            );


                        });
                    },
                    error: function(error) {
                        console.error('Error fetching search results', error);
                    }
                });
            });

            $('#searchCustomerInput').on('input', function() {
                let query = $(this).val();
                $.ajax({
                    url: '/search-customer',
                    method: 'POST',
                    data: {
                        search: query,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#searchResults').empty();
                        let resultsContainer = $('#searchResults');
                        $.each(response, function(index, customer) {
                            resultsContainer.append(
                                '<li class="search-result-item" data-customer-id="' +
                                customer.id + '">' + customer.first_name + ' ' + (
                                    customer.last_name ? customer.last_name : '') +
                                (customer.phone ? ' - ' + customer.phone : (customer
                                    .email ? ' - ' + customer.email : '')) + '</li>'
                            );


                        });
                    },
                    error: function(error) {
                        console.error('Error fetching search results', error);
                    }
                });
            });

        });

        // Function to handle click on search result
        $(document).on('click', '.search-result-item', function() {
            var customerId = $(this).data('customer-id'); // Get the customer ID from the clicked result
            // Make an AJAX request to fetch the customer data
            $.ajax({
                url: '/fetch-customer',
                type: 'GET',
                data: {
                    customerId: customerId
                },
                success: function(response) {
                    // Populate the form with the fetched data
                    $('#customerId').val(response
                    .id); // Assuming there's an input field with ID "customerId" for storing the ID
                    $('#customerFirstName').val(response.first_name);
                    $('#customerLastName').val(response.last_name);
                    $('#email').val(response.email);

                    // $('#customerGroup').val(response.customer_group);
                    $('#countryCode').val(response.country_code);
                    $('#mobilePhone').val(response.phone);

                    if (response.driving_license && response.driving_license.trim() !== '') {
                        var drivingLicenseImageUrl = window.location.origin + '/public/' + response
                            .driving_license;
                        // Set the source of the image with the new URL
                        $('#drivingLicensePreview').attr('src', drivingLicenseImageUrl);

                    } else {
                        // Optionally, you can set a default image or hide the image element
                        $('#drivingLicensePreview').attr('src', 'https://placehold.it/180');
                        // OR $('#drivingLicensePreview').hide();
                        $isValid = false;
                        $('drivingLicenseError').innerhtml('This field is required');

                    }

                    var isEmailChecked = response.info.email_notification === 1;
                    $('#emailNotificationCheckbox').prop('checked', isEmailChecked);

                    var isSmsChecked = response.info.sms_notification === 1;
                    $('#smsNotificationCheckbox').prop('checked', isSmsChecked);

                    $('#streetAddress').val(response.address.street_address);
                    $('#houseNumber').val(response.address.house_number);
                    $('#city').val(response.address.city);
                    $('#state').val(response.address.state);
                    $('#postcode').val(response.address.postcode);
                    $('#country').val(response.address.country);
                    $('#location').val(response.address.location);

                    $('#searchResults').empty();

                },
                error: function(error) {
                    console.error('Error fetching customer data', error);
                }
            });
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('#searchContainer').length) {
                $('#searchResults').empty();
            }
        });


        function showAddressFields(event) {
            event.preventDefault();
            var addressSection = document.getElementById("addressSection");
            var optionalText = document.getElementById("optionalText");
            var firstInput = $('#addressSection input').first();

            if (addressSection.classList.contains("d-none")) {
                addressSection.classList.remove("d-none");
                // Focus on the first input field in the address section
                if (firstInput) {
                    firstInput.focus();
                }
                optionalText.textContent = "(click to hide)"; // Change text to "(required)"
            } else {
                addressSection.classList.add("d-none");
                optionalText.textContent = "(click to show)"; // Change text back to "(optional)"
            }

        }
    </script>
    <script>
        function checkFormFields() {
            var deviceModel = document.getElementById('deviceModel').value.trim();
            var deviceBrand = document.getElementById('deviceBrand').value.trim();
            var imei = document.getElementById('imei').value.trim();
            var mobilePin = document.getElementById('mobilePin').value.trim();



            var sellPrice = document.getElementById('sellingPrice').value.trim();
            var buyPrice = document.getElementById('buyingPrice').value.trim();


            // Add more fields as needed

            // Enable the button if all fields are filled
            var printLabelBtn = document.getElementById('printLabelBtn');
            printLabelBtn.disabled = !(deviceModel && sellPrice && mobilePin && deviceBrand && buyPrice &&
                imei /* && add more conditions as needed */ );
        }

        // Attach the checkFormFields function to the input fields' change event
        document.getElementById('deviceModel').addEventListener('input', checkFormFields);
        document.getElementById('sellingPrice').addEventListener('input', checkFormFields);
        document.getElementById('imei').addEventListener('input', checkFormFields);
        document.getElementById('mobilePin').addEventListener('input', checkFormFields);

        document.getElementById('buyingPrice').addEventListener('input', checkFormFields);
        document.getElementById('deviceBrand').addEventListener('input', checkFormFields);

        function printLabel() {
            var deviceModel = document.getElementById('deviceModel').value;
            var deviceBrand = document.getElementById('deviceBrand').value;
            var sellPrice = document.getElementById('sellingPrice').value;
            var buyPrice = document.getElementById('buyingPrice').value;
            var imei = document.getElementById('imei').value;
            var mobilePin = document.getElementById('mobilePin').value;


            // Open a new tab
            var printWindow = window.open('', '_blank');

            // Write HTML content for the label
            printWindow.document.write(`
            <html>
            <head>
                <title>Phone Label</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                    }
                    .label {
                        margin: 20px;
                    }
                    .label-item {
                        margin-bottom: 10px;
                    }
                </style>
            </head>
            <body>
                <div class="label">
                    <div class="label-item"><strong>Device Model:</strong> ${deviceModel}</div>
                    <div class="label-item"><strong>Device Brand:</strong> ${deviceBrand}</div>
                    <div class="label-item"><strong>Sell Price:</strong> ${sellPrice}</div>
                    <div class="label-item"><strong>Buy Price:</strong> ${buyPrice}</div>
                    <div class="label-item"><strong>IMEI:</strong> ${imei}</div>
                    <div class="label-item"><strong>Mobile Pin:</strong> ${mobilePin}</div>

                </div>
            </body>
            </html>
        `);

            // Close the document
            printWindow.document.close();

            // Print the label
            printWindow.print();
        }



        // Attach the printLabel function to the "Print Label" button click event
        document.getElementById('printLabelBtn').addEventListener('click', printLabel);
    </script>
@endpush
