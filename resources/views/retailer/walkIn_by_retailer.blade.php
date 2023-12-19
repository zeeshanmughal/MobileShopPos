@extends('layouts.retailer')
@push('styles')
    <style>
        .error-message {
            color: red;
            font-size: 14px;
        }

        .styled-link {
            color: #007bff;
            /* Blue color */
            text-decoration: none;
            /* Remove underline */
            font-weight: bold;
            /* Make it bold */
        }

        .styled-link:hover {
            color: #0056b3;
            /* Darker blue on hover */
        }

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

        #searchCustomerResults {
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

        .search-result-issue-item {
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        .position-relative {
            position: relative;
        }

        .position-absolute {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            /* Adjust the z-index as needed */
        }
    </style>
@endpush
@section('content')
@include('retailer.partials.response_message')

    <form method="POST" action="{{ route('service-detail.store') }}" id="walkInCustomerServiceDetailForm" class="toggle_profile"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="customer_type" value="walk-in-by-retailer">
        <input type="hidden" name="customer_id" id="customerId">
        <input type="hidden" name="service_details[0][device_issue_id]" id="issueId">
        <input type="hidden" name="email_notification" id="emailNotification">
        <input type="hidden" name="sms_notification" id="smsNotification">
        <input type="hidden" name="service_details[0][inventory_item_id]" id="hiddenInventoryItemId">


        <div container>
            <div class="row ">
                {{-- Service detail --}}
                <div class="col-md-6 ">
                    <div class="accordionExample1 p-3 form-wrap">
                        <div class="" id="headingOne">
                            <h4 class="mb-0 row align-items-center">
                                <div class="col-md-6" aria-expanded="true">
                                    <img src="{{ retailer_asset('img/icon.png') }}"> <span
                                        class="text-gray-900 pb-0 fw-bold">Service Details</span>
                                </div>
                                <div class="col-md-6">

                                </div>
                            </h4>
                        </div>
                        <div id="" class=" show pt-4" aria-labelledby="headingOne"
                            data-parent=".accordionExample1">
                            <div class="row">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Device Name</label>
                                        <input list="device_names" name="service_details[0][device_name]"
                                            class="form-control" />
                                        <datalist id="device_names">
                                            <option value="Iphone 13pro">
                                            <option value="Samsung S22">
                                            <option value="Techno Cammon">
                                            <option value="HTC Desire S">
                                            <option value="Google Pixel 3">
                                            <option value="Infinix Desire">
                                        </datalist>
                                        {{-- <input type="text" name="service_details[0][device_name]"
                                            placeholder="Enter Device Name" class="form-control"> --}}
                                        <div id="deviceNameError" class="error-message"></div>

                                    </div>
                                </div>





                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="deviceIssue">Device Issue</label>
                                        <div id="searchIssueContainer" class="position-relative">
                                            <div class="input-group">
                                                <input type="text" name="service_details[0][device_issue]"
                                                    class="form-control" id="deviceIssue" oninput="searchDeviceIssue()"
                                                    autocomplete="off">
                                                <div class="input-group-append">
                                                    <button class="btn bg-gradient-primary text-white py-0 px-3 "
                                                        onclick="openConfirmModal(event)" data-toggle="tooltip"
                                                        title="Click to add new issue">+</button>
                                                </div>
                                            </div>

                                            <div id="searchIssueResults"
                                                class="search-results position-absolute position-relative"
                                                style="width: 100%;"></div>

                                        </div>
                                        <div id="deviceIssueError" class="error-message"></div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <input type="text" name="service_details[0][description]" class="form-control">
                                    </div>
                                </div>


                                {{-- <a href="#" class="text-primary">Add Diagnostic/ Internal Notes</a> --}}

                                {{-- <td> --}}
                                {{-- <a href="#" class="text-primary">Manage Custom Fields</a> --}}
                                {{-- </td> --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Imei or Serial number</label>

                                        <input type="text" name="service_details[0][imei_or_serial]"
                                            placeholder="Enter IMEI Number" class="form-control">
                                        <div id="imeiError" class="error-message"></div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Mobile Pin</label>

                                        <input type="text" name="service_details[0][mobile_pin]"
                                            placeholder="Enter Mobile Pin" class="form-control">
                                        <div id="mobilePinError" class="error-message"></div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inventoryItemInput">Inventory Item</label>
                                        <input list="inventory_items" name="service_details[0][inventory_item]"
                                            class="form-control" id="inventoryItemInput"
                                            oninput="updateInventoryItemId(this)" autocomplete="off" />
                                        <datalist id="inventory_items">
                                            @foreach ($inventoryItems as $item)
                                                <option value="{{ $item->item_name }}" data-item-id="{{ $item->id }}">
                                            @endforeach
                                        </datalist>

                                        <div id="inventoryItemError" class="error-message"></div>
                                    </div>
                                </div>

                                <div class="col-md-6"></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Repair Status</label>

                                        <select id="dropdown" name="service_details[0][repair_status]"
                                            class="form-control">
                                            {{-- <option disabled selected value>Select Status</option> --}}
                                            <option value="pending" selected>Pending</option>
                                            {{-- <option value="in_progress">In Progress</option> --}}
                                            {{-- <option value="repaired">Repaired</option> --}}
                                            {{-- <option value="completed">Completed</option> --}}
                                            {{-- <option value="unlocked">Unlocked</option> --}}
                                            {{-- <option value="repaired_and_collected">Repaired & Collected</option> --}}

                                        </select>
                                    </div>
                                </div>

                                {{-- <a href="#" class="text-primary"></a> --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Pickup Days</label>

                                        <input type="number" name="service_details[0][pickup_days]" placeholder=""
                                            class="form-control" min="0">
                                        <div id="pickupDaysError" class="error-message"></div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Pickup Hours</label>

                                        <input type="number" name="service_details[0][pickup_hours]" placeholder=""
                                            class="form-control" min="0">
                                        <div id="pickupHoursError" class="error-message"></div>

                                    </div>
                                </div>
                                {{-- <a href="#" class="text-primary">Repaired & Collected</a> --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Quantity</label>

                                        <input type="number" name="service_details[0][quantity]" min="1"
                                            placeholder="0" class="form-control" id="quantity">
                                        <div id="quantityError" class="error-message"></div>

                                    </div>
                                </div>
                                {{-- <a href="#" class="text-primary"></a> --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Price</label>

                                        <input type="number" name="service_details[0][price]" placeholder=""
                                            min="0" class="form-control" id="price">
                                        <div id="priceError" class="error-message"></div>

                                    </div>
                                </div>
                                {{-- <a href="#" class="text-primary">Discount</a> --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Tax <small>%</small></label>

                                        <input type="number" name="service_details[0][tax]" min="0"
                                            placeholder="" class="form-control" id="taxPercentage">
                                        <div id="taxError" class="error-message"></div>

                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>

                </div>

                {{-- Walkin Customer --}}
                <div class="col-md-6 fixed-height-card">
                    <div class="accordionExample1 p-3 form-wrap">
                        <div class="" id="headingOne">
                            <h4 class="mb-0 row align-items-center">
                                <div class="col-md-6" aria-expanded="true">
                                    <img src="{{ retailer_asset('img/icon.png') }}"> <span
                                        class="text-gray-900 pb-0 fw-bold">Walkin Customer</span>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-0 d-flex" id="searchContainer">
                                        <input type="text" name="search_customer" id="searchCustomerInput"
                                            class="form-control mr-1" placeholder="Search Customer" autocomplete="off">
                                        <div id="searchCustomerResults" class="search-results"></div>

                                        <a class="btn bg-gradient-primary text-white py-1 px-1 "
                                            href = '{{ route('customer.create') }}'">New</a>
                                    </div>
                                    <div id="searchCustomerError" class="error-message"></div>
                                </div>
                            </h4>
                        </div>
                        <div id="" class=" show pt-4" aria-labelledby="headingOne"
                            data-parent=".accordionExample1">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label id="name-label" for="name">First Name</label>
                                        <input type="text" name="first_name" id="customerFirstName" placeholder=""
                                            class="form-control makeDisable">
                                        <div id="customerFirstNameError" class="error-message"></div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Last Name</label>
                                        <input type="text" name="last_name" placeholder="" id="customerLastName"
                                            class="form-control makeDisable">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Country Code</label>
                                        <input type="text" name="country_code" id="countryCode"
                                            class="form-control makeDisable" value="+44">

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Phone Number</label>
                                        <div class="d-flex">
                                            <input type="text" id="mobilePhone" class="form-control makeDisable"
                                                placeholder="Phone Number" name="phone">
                                            {{-- <button class="btn bg-gradient-primary text-white py-0 px-3  ml-1">+</button> --}}
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label id="email-label" for="email">Email</label>
                                        <div class="d-flex">
                                            <input type="email" name="email" id="email" placeholder=""
                                                class="mr-1 form-control makeDisable">
                                            {{-- <button class="btn bg-gradient-primary text-white py-0 px-3 ">+</button> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group Picture_2">
                                        <label for="">Driving License or <small>(any id proof)</small> </label>
                                        <div class="d-flex">
                                            <img id="drivingLicensePreview" src="https://placehold.it/180"
                                                class="blah mr-1 previewImage" alt="Id Proof Image" />
                                            <input type='file' name="driving_license" class="form-control"
                                                id="drivingLicense" accept="image/*"
                                                onchange="readURL(this, 'drivingLicensePreview');" />
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <strong>Notifications</strong>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="sms_notification" id="smsNotificationCheckbox">
                                                    <label class="custom-control-label" for="smsNotificationCheckbox">SMS
                                                        Notifications</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="email_notification" id="emailNotificationCheckbox">
                                                    <label class="custom-control-label"
                                                        for="emailNotificationCheckbox">Email
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
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">House/Aprt/Floor No#</label>
                                            <input type="text" name="house_number" id="houseNumber"
                                                class="form-control">
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
                            </div>

                            <div class="mt-4">
                                <h5 class="font-bold "><strong>Ticket Summary</strong></h5>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Created On</label>
                                        <input type="date" name="created_on" id="dateInput" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Location</label>
                                        <input type="text" name="location" id="location" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>





                <div class="col-md-12 mt-3 font-14 service_details">
                    <div class="accordionExample4 p-0 form-wrap">
                        <div class="accord-header px-3 py-2" id="heading4">
                            <h4 class="mb-0 align-items-center">
                                <div data-toggle="collapse" data-target="#collapse4" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    <span class="text-gray-100 pb-0 fw-bold">Unlocking</span>
                                </div>
                            </h4>
                        </div>
                        <div id="collapse4" class="collapse show pt-4 px-3 pb-2 row" aria-labelledby="heading4"
                            data-parent=".accordionExample4">
                            <div class="col-md-7"></div>
                            <div class="col-md-5">
                                <table class="table table-bordered text-dark font-weight-bold">
                                    <thead>
                                        <tr>
                                            <th scope="col">
                                                <p>Sub Total</p><br>Discount<br>
                                                <p> Tax</p>
                                            </th>
                                            <th scope="col">
                                                <p id="subTotal"> 0.00 </p>
                                                <div class="form-group mb-0 py-1">
                                                    <div class="input-group">
                                                        <input type="text" name="bill_discount" id="billDiscount"
                                                            placeholder="0.00" class=" form-control px-2">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"
                                                                style="font-size:0.75rem;">%</span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <p id="taxAmount">0.00</p>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p> Total</p> <br>
                                                <p>Total Paid</p>
                                            </td>
                                            <td>
                                                <p id="totalPrice">0.00</p> <br>
                                                <input type="text" name="total_paid" id="totalPaidAmount"
                                                    class="form-contol">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Due</td>
                                            <td>
                                                <p id="dueAmount">0.00</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="row mt-3">
                <div class="col-md-12 text-right">
                    <button type="submit" id="submitServiceBtn" class="btn bg-gradient-primary text-white mb-4 ">Save
                        Customer Service
                        Details</button>
                    {{-- <button id="saveWalkInCustomer" class="btn bg-gradient-primary text-white " >Save Customer Service
                    Details</button> --}}
                    {{-- <button id="saveAndAdd" class="btn bg-gray-800 text-white ">Save & add another Customer</button>
                <button id="cancel" class="btn bg-gray-300 text-dark ">Cancel</button> --}}
                </div>
            </div>

    </form>
    <!-- Confirm Issue Modal -->
    <div class="modal fade" id="confirmIssueModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to add this new issue?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="addNewIssue(event)">Confirm</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

    <script>

        $(document).ready(function() {
            // Attach an event listener to all input fields with the class 'form-control'
            $('.makeDisable').on('focus', function() {
                // Get the ID of the current input field
                var inputId = $(this).attr('id');
                var inputVal = $(this).val();
                console.log($(this).val());
                if (inputVal == '') {
                    displayError('searchCustomerError', 'You can search and select customer');

                } else {
                    displayError('searchCustomerError', '');

                }

                // Show an error message for the current input field
                // $('#' + inputId + 'Error').html('Editing not allowed').addClass('text-danger');

                // Prevent the user from editing the current input field
                $(this).prop('readonly', true);
            });
        });
    </script>

    <script>
        // Set the current date in the input on page load
        document.addEventListener("DOMContentLoaded", function() {
            var currentDate = new Date().toLocaleDateString('en-CA'); // Get current date in YYYY-MM-DD format
            document.getElementById("dateInput").value = currentDate;
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
                        $('#searchCustomerResults').empty();
                        let resultsContainer = $('#searchCustomerResults');
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
                        $('#searchCustomerResults').empty();
                        let resultsContainer = $('#searchCustomerResults');
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
                    $('#customerFirstName').val(response.first_name).prop('readonly', true);
                    $('#customerLastName').val(response.last_name).prop('readonly', true);
                    $('#email').val(response.email).prop('readonly', true);
                    $('#customerGroup').val(response.customer_group).prop('readonly', true);
                    $('#countryCode').val(response.country_code).prop('readonly', true);
                    $('#mobilePhone').val(response.phone).prop('readonly', true);
                    // Check if response.driving_license exists and is not empty
                    if (response.driving_license && response.driving_license.trim() !== '') {
                        var drivingLicenseImageUrl = window.location.origin + '/' + response
                            .driving_license;
                        // Set the source of the image with the new URL
                        $('#drivingLicensePreview').attr('src', drivingLicenseImageUrl);
                    } else {
                        // Optionally, you can set a default image or hide the image element
                        $('#drivingLicensePreview').attr('src', 'https://placehold.it/180');
                        // OR $('#drivingLicensePreview').hide();
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



                    // Close the dropdown
                    $('#searchCustomerResults').empty();

                },
                error: function(error) {
                    console.error('Error fetching customer data', error);
                }
            });
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('#searchContainer').length) {
                $('#searchCustomerResults').empty();
            }
        });
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#searchIssueContainer').length) {
                $('#searchIssueResults').empty();
            }
        });
    </script>

    {{-- Service Detail Row frist --}}
    <script>
        $(document).ready(function() {
            // Function to update total and subtotal
            function updateTotals() {
                // Get values from the input fields
                var price = parseFloat($('#price').val()) || 0;
                var quantity = parseInt($('#quantity').val()) || 1;
                var taxPercentage = parseFloat($('#taxPercentage').val()) || 0;
                var totalPaidAmount = parseFloat($('#totalPaidAmount').val()) || 0;
                var discountPercentage = parseFloat($('#billDiscount').val()) || 0;


                // Calculate subtotal and total
                var subtotal = price * quantity;
                var taxAmount = (subtotal * taxPercentage) / 100;
                var totalBeforeDiscount = subtotal + taxAmount;
                var discountAmount = (discountPercentage / 100) * totalBeforeDiscount;
                var total = totalBeforeDiscount - discountAmount; // You can add tax, discount, etc. if needed
                var dueAmount = total - totalPaidAmount;

                // Update the HTML with the new values
                $('#subTotal').text(subtotal.toFixed(2));
                $('#taxAmount').text(taxAmount.toFixed(2));
                $('#totalPrice').text(total.toFixed(2));
                $('#dueAmount').text(dueAmount.toFixed(2));

            }

            // Attach the input event to the price and quantity fields
            $('#price, #quantity, #taxPercentage, #totalPaidAmount, #billDiscount').on('input', function() {
                updateTotals();
            });

            // Initial update when the page loads
            updateTotals();
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
    {{-- Validate Form Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add an event listener to the button
            const addButton = document.getElementById('submitServiceBtn');
            addButton.addEventListener('click', function(event) {
                // Prevent the default button click behavior
                event.preventDefault();

                // Validate the form
                if (validateForm()) {
                    // If the form is valid, submit it
                    const form = document.getElementById(
                        'walkInCustomerServiceDetailForm'); // Replace 'yourFormId' with the actual ID of your form
                    form.submit();
                } else {
                    document.documentElement.scrollTop = 0;
                }
            });
        });
  

        function validateForm() {
            clearErrors();
            // Flag to check if the form is valid
            let isValid = true;



            // Validate Device Brand
            const deviceName = document.querySelector('input[name="service_details[0][device_name]"]').value;
            if (deviceName.trim() === '') {
                displayError('deviceNameError', 'Please enter a Device Name.');
                isValid = false;
            }

            // Validate Device Issue
            const deviceIssue = document.querySelector('input[name="service_details[0][device_issue]"]').value;
            if (deviceIssue.trim() === '') {
                displayError('deviceIssueError', 'Please enter a Device Issue.');
                isValid = false;
            }

            // Validate IMEI or Serial Number
            const imei = document.querySelector('input[name="service_details[0][imei_or_serial]"]').value;
            if (imei.trim() === '') {
                displayError('imeiError', 'Please enter your imei or serial number.');
                isValid = false;
            }

            // Validate Mobile Pin
            const mobilePin = document.querySelector('input[name="service_details[0][mobile_pin]"]').value;
            if (mobilePin.trim() === '') {
                displayError('mobilePinError', 'Please enter your mobile pin.');
                isValid = false;
            }

            // Validate Inventory Item
            const inventoryItem = document.querySelector('input[name="service_details[0][inventory_item]"]').value;
            if (inventoryItem.trim() === '') {
                displayError('inventoryItemError', 'Select you inventory item');
                isValid = false;
            }

            
            const selectedCustomer = document.getElementById('customerId').value;
            if (selectedCustomer.trim() == '') {
                displayError('searchCustomerError', 'Please search and select customer');
                isValid = false;
            }

            // Validate Repair Time
            const pickupDays = document.querySelector('input[name="service_details[0][pickup_days]"]').value;
            const pickupHours = document.querySelector('input[name="service_details[0][pickup_hours]"]').value;

            if (pickupDays.trim() === '' && pickupHours.trim() === '') {
                displayError('pickupDaysError', 'Please select a pickup time.');
                isValid = false;
            }

            // Validate Quantity
            const quantity = document.querySelector('input[name="service_details[0][quantity]"]').value;
            if (quantity.trim() === '' || quantity <= 0) {
                displayError('quantityError', 'Please enter a valid Quantity.');
                isValid = false;
            }

            // Validate Price
            const price = document.querySelector('input[name="service_details[0][price]"]').value;
            if (price.trim() === '' || price < 0) {
                displayError('priceError', 'Please enter a valid Price.');
                isValid = false;
            }

            // Validate Tax Percentage
            // const taxPercentage = document.querySelector('input[name="service_details[0][tax]"]').value;
            // if (taxPercentage.trim() === '' || taxPercentage < 0) {
            //     displayError('taxError', 'Please enter a valid Tax Percentage.');
            //     isValid = false;
            // }

            // Return the result of form validation
            return isValid;


     
        }



        function isValidEmail(email) {
            // You can implement a more sophisticated email validation
            // This is a simple example
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function isValidPhoneNumber(phoneNumber) {
            // Basic validation for a ten-digit phone number
            var phoneRegex = /^\d{10}$/;
            return phoneRegex.test(phoneNumber);
        }

        function displayError(elementId, message) {
            var errorElement = document.getElementById(elementId);
            errorElement.textContent = message;
        }

        function clearErrors() {
            var errorElements = document.querySelectorAll('.error-message');
            errorElements.forEach(function(element) {
                element.textContent = '';
            });
        }
    </script>

    {{-- Script for Device Issues  --}}
    <script>
        function searchDeviceIssue() {
            var searchTerm = $('#deviceIssue').val();

            // Make an AJAX request
            $.ajax({
                type: 'GET',
                url: '/search-device-issues', // Replace with your actual endpoint
                data: {
                    term: searchTerm
                },
                success: function(response) {
                    // Handle the response and update the search results
                    displaySearchResults(response);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }

        function displaySearchResults(results) {
            var searchResultsContainer = $('#searchIssueResults');
            searchResultsContainer.empty();

            // Display the results in the searchResultsContainer
            if (results.length > 0) {
                var resultList = '<ul>';
                results.forEach(function(result) {
                    resultList += '<li class="search-result-issue-item" data-issue-id="' + result.id + '">' + result
                        .issue_description + '</li>';
                });
                resultList += '</ul>';
                searchResultsContainer.html(resultList);
                // Add click event listener to set input value on click
                $('.search-result-issue-item').click(function() {
                    var selectedValue = $(this).data('issue-id');
                    var selectedDescription = $(this).text();
                    $('#issueId').val(selectedValue);
                    $('#deviceIssue').val(selectedDescription).data('selected-id', selectedValue);
                    searchResultsContainer.empty(); // Clear results after selection
                    $('#searchIssueResults').empty();
                });
            } else {
                searchResultsContainer.html('<p>No results found.</p>');
            }
        }

        function addNewIssue(event) {
            event.preventDefault();
            // Handle the click event on the button

            // Get data from the form
            var issueDescription = $('#deviceIssue').val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            console.log(issueDescription);
            // Make an AJAX request
            $.ajax({
                type: 'POST',
                url: '/device-issue/add', // Replace with your actual PHP script URL

                data: {
                    issueDescription: issueDescription,
                    _token: csrfToken
                },
                success: function(response) {
                    // Handle the response from the server
                    console.log(response);
                    // Update the dropdown with the new issues


                    if (response.status === 'success') {
                        alert('Issue added Successfully');
                    } else {
                        alert('Issue already exists or other error occurred');
                    }

                    searchDeviceIssue();
                    displaySearchResults(response);

                    // Close the modal
                    $('#confirmIssueModal').modal('hide');


                },
                error: function(error) {
                    console.error('Error:', error);
                    // alert('An error occurred while adding the issue');

                }
            });

        }

        function updateInventoryItemId(input) {
            var selectedOption = getSelectedOption(input.value);
            if (selectedOption) {
                var itemId = selectedOption.getAttribute('data-item-id');
                // Set the hidden input value to the selected item ID
                document.getElementById('hiddenInventoryItemId').value = itemId;
            } else {
                // Handle the case when no option is selected
                document.getElementById('hiddenInventoryItemId').value = '';
            }
        }

        function getSelectedOption(inputValue) {
            var options = document.getElementById('inventory_items').getElementsByTagName('option');
            for (var i = 0; i < options.length; i++) {
                if (options[i].value === inputValue) {
                    return options[i];
                }
            }
            return null;
        }

        function openConfirmModal(event) {
            event.preventDefault();
            var issueDescription = $('#deviceIssue').val();

            // Check if the input is empty
            if (issueDescription.trim() === '') {
                // If the input is empty, do not open the modal
                alert('Please enter an issue description before proceeding.');
                return;
            }
            $('#confirmIssueModal').modal('show');
        }
    </script>
@endpush
