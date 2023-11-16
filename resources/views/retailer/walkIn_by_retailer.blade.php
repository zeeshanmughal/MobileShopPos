@extends('layouts.retailer')
@push('styles')
    <style>
        .error-message {
            color: red;
            font-size: 14px;
        }

        .search-results {
            position: absolute;
            top: 77px;
            /* Adjust this value based on your layout */
            z-index: 1000;
            background-color: #fff;
            border: 1px solid #ddd;
            width: 100%;
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
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <form method="POST" action="{{ route('service-detail.store') }}" id="walkInCustomerForm" class="toggle_profile" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="customer_type" value="walk-in-by-retailer">
        <input type="hidden" name="customer_id" id="customerId">
        <input type="hidden" name="service_details[0][device_issue_id]" id="issueId">
        <input type="hidden"  name="email_notification" id="emailNotification">
        <input type="hidden" name="sms_notification" id="smsNotification">

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
                                        <label for="">Repair Category</label>
                                        <select id="dropdown" name="service_details[0][repair_category]"
                                            id="repairCategory" class="form-control">
                                            <option disabled selected value>Select</option>
                                            <option value="Individual">Student</option>
                                            <option value="preferNo">Prefer not to say</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <div id="repairCategoryError" class="error-message"></div>
                                    </div>
                                </div>


                                {{-- <a href="#" class="text-primary">Additional Note</a>  --}}

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Select Device</label>

                                        <select id="dropdown" name="service_details[0][device]" class="form-control">
                                            <option disabled selected value>Select Device</option>
                                            <option value="apple">Apple</option>
                                            <option value="samsung">Samsung</option>
                                            <option value="google">Google</option>
                                        </select>
                                        <div id="selectDeviceError" class="error-message"></div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Device Brand</label>
                                        <input type="text" name="service_details[0][device_brand]" placeholder=""
                                            class="form-control">
                                        <div id="deviceBrandError" class="error-message"></div>

                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Device Issue</label>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <select name="service_details[0][device_issue]" class="form-control" id="deviceIssue">
                                                    <option>Issue 1</option>
                                                    <option>Issue 2</option>
                                                    <option>Issue 3</option>

                                                </select>
                                                <div class="input-group-append">
                                                    <button id="addIssueBtn"
                                                        class="btn bg-gradient-primary text-white py-0 px-3" type="button"
                                                        data-toggle="modal" data-target="#addIssueModal">+</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div> --}}

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="deviceIssue">Device Issue</label>
                                        <div id="searchIssueContainer" class="position-relative">
                                            <div class="input-group">
                                                <input type="text" name="device_issue" class="form-control"
                                                    id="deviceIssue" oninput="searchDeviceIssue()">
                                                <div class="input-group-append">
                                                    <button class="btn bg-gradient-primary text-white py-0 px-3 "
                                                        onclick="openConfirmModal(event)">+</button>
                                                </div>
                                            </div>
                                            <div id="deviceIssueError" class="error-message"></div>

                                            <div id="searchIssueResults"
                                                class="search-results position-absolute position-relative"
                                                style="width: 100%;"></div>
                                        </div>
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
                                {{-- <a href="#" class="text-primary">Serial Number</a> --}}
                                <div class="col-md-6">
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
                                {{-- <a href="#" class="text-primary">Task Type</a> --}}
                                <div class="col-md-6">
                                    <label for="">Repair Time</label>

                                    <div class="form-group">
                                        <input type="date" name="service_details[0][repair_time]" class="form-control">
                                        <div id="repairTimeError" class="error-message"></div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Assigned To</label>

                                        <input type="text" name="service_details[0][assigned_to]"
                                            placeholder="Hassam Ali" disabled class="form-control">
                                        <div id="assignedToError" class="error-message"></div>

                                    </div>
                                </div>
                                {{-- <a href="#" class="text-primary"></a> --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Pickup Time</label>

                                        <input type="date" name="service_details[0][pickup_time]" placeholder=""
                                            class="form-control">
                                        <div id="pickupTimeError" class="error-message"></div>

                                    </div>
                                </div>
                                {{-- <a href="#" class="text-primary">Repaired & Collected</a> --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Quantity</label>

                                        <input type="number" name="service_details[0][quantity]" min="1"
                                            placeholder="1" class="form-control" id="quantity">
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
                                {{-- <a href="#" class="text-primary">GST Class</a> --}}

                                {{-- < --}}
                                {{-- <button
                                        class="btn bg-gradient-primary text-white text-white font-12 p-1 add-row-btn">Add
                                        Row</button> --}}

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
                                            class="form-control mr-1" placeholder="Search Customer">
                                        <div id="searchCustomerResults" class="search-results"></div>

                                        <button class="btn bg-gradient-primary text-white py-0 px-1 "
                                            onclick="window.location.href = '{{ route('customer.create') }}'">New</button>
                                    </div>
                                </div>
                            </h4>
                        </div>
                        <div id="" class=" show pt-4" aria-labelledby="headingOne"
                            data-parent=".accordionExample1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Customer Group</label>
                                        <input type="text" name="customer_group" id="customerGroup" placeholder=""
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Change Carriers</label>
                                        <input type="text" name="change_carrier" id="changeCarrier" placeholder=""
                                            class="form-control">
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tax Class</label>
                                    <select id="dropdown" name="tax_class" id="taxClass" class="form-control" >
                                        <option disabled selected value>Select</option>
                                        <option value="Individual">Student</option>
                                        <option value="preferNo">Prefer not to say</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div> --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label id="name-label" for="name">First Name</label>
                                        <input type="text" name="first_name" id="customerFirstName" placeholder=""
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Last Name</label>
                                        <input type="text" name="last_name" placeholder="" id="customerLastName"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label id="email-label" for="email">Email</label>
                                        <div class="d-flex">
                                            <input type="email" name="email" id="email" placeholder=""
                                                class="mr-1 form-control">
                                            {{-- <button class="btn bg-gradient-primary text-white py-0 px-3 ">+</button> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Phone</label>
                                        <div class="d-flex">
                                            <input type="text" id="phone" class="form-control"
                                                placeholder="Phone Number" name="phone">
                                            {{-- <button class="btn bg-gradient-primary text-white py-0 px-3  ml-1">+</button> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Action</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="action" id="repairOption"
                                            value="repair" checked>
                                        <label class="form-check-label" for="repairOption">
                                            Repair Phone
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="action" id="sellOption"
                                            value="sell">
                                        <label class="form-check-label" for="sellOption">
                                            Sell Phone
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Driving license</label>
                                        <input type="text" name="driving_license" id="drivingLicense" placeholder=""
                                            class="form-control">
                                        <small id="drivingLicenseMessage" class="text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <strong>Notifications</strong>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6>Email Alert</h6>
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="button" name="email_notification"
                                                class="btn btn-xs btn-toggle active" id="emailAlert" data-toggle="button"
                                                aria-pressed="false" autocomplete="off">
                                                <div class="handle"></div>
                                            </button>
                                        </div>

                                        <div class="col-sm-3">
                                            <h6>SMS Alert</h6>
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="button" name="sms_notification" id="smsAlert"
                                                class="btn btn-xs btn-toggle active" data-toggle="button"
                                                aria-pressed="false" autocomplete="off">
                                                <div class="handle"></div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 pt-4">
                                    <a href="#" class="text-primary font-weight-bold"
                                        onclick="showAddressFields(event)"><u>
                                            <strong> Add Address <small>optional</small></strong> </u></a>
                                </div>
                            </div>
                            <div class="row" style="display:none" id="addressSection">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Street Address </label>
                                        <input type="text" name="street_address"id="streetAddress"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">House/ Aprt/ Floor No #</label>
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
                            {{-- </div> --}}
                            <div class="mt-4">
                                <h5 class="font-bold "><strong>Ticket Summary</strong></h5>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Created On</label>
                                        <input type="date" name="created_on" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Location</label>
                                        <input type="text" name="location" class="form-control">
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
                    <button type="submit" id="submitServiceBtn" class="btn bg-gradient-primary text-white ">Save
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
                    $('#customerFirstName').val(response.first_name).prop('readonly', true);
                    $('#customerLastName').val(response.last_name).prop('readonly', true);
                    $('#customerGroup').val(response.customer_group).prop('readonly', true);
                    $('#phone').val(response.phone).prop('readonly', true);
                    $('#drivingLicense').val(response.driving_license);
                    $('#email').val(response.email).prop('readonly', true);
                    // Add other fields as needed

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
        let rowCount = 1;

        function addRow() {
            // const tableBody = $('#service-details-table').find('tbody');
            // let newRow = `<tr class="service-details-row">` +
            //     `<th scope="row"></th>` +
            //     `<td><div class="form-group"><select name="service_details[${rowCount}][repair_category]" class="form-control" ><option disabled selected value>Select Category</option><option value="Individual">Student</option><option value="preferNo">Prefer not to say</option><option value="other">Other</option></select></div></td>` +
            //     `<td><div class="form-group"><select name="service_details[${rowCount}][device]" class="form-control"><option disabled selected value>Select Device</option><option value="apple">Apple</option><option value="samsung">Samsung</option><option value="google">Google</option></select></div></td>` +
            //     `<td><div class="form-group"><input type="text" name="service_details[${rowCount}][device_issue]" placeholder="" class="form-control"></div></td>` +
            //     `<td><div class="form-group"><input type="text" name="service_details[${rowCount}][imei_or_serial]" placeholder="Enter IMEI Number" class="form-control"></div></td>` +
            //     `<td><div class="form-group"><select name="service_details[${rowCount}][repair_status]" class="form-control"> <option value="pending" selected>Pending</option></select></div></td>` +
            //     `<td><div class="form-group"><input type="date" name="service_details[${rowCount}][repair_time]" class="form-control"></div></td>` +
            //     `<td><div class="form-group"><input type="text" name="service_details[${rowCount}][assigned_to]" placeholder="Hassam Ali" class="form-control" disabled></div></td>` +
            //     `<td><div class="form-group"><input type="date" name="service_details[${rowCount}][pickup_time]" placeholder="" class="form-control"></div></td>` +
            //     `<td><div class="form-group"><input type="number" name="service_details[${rowCount}][quantity]" placeholder="1" min="1" class="form-control"></div></td>` +
            //     `<td><div class="form-group"><input type="number" name="service_details[${rowCount}][price]" placeholder="" min="0" class="form-control" "></div></td>` +
            //     `<td><div class="form-group"><input type="number" name="service_details[${rowCount}][tax]" placeholder="" min="0" class="form-control"></div></td>` +
            //     `<td><button class="btn bg-gradient-primary text-white text-white font-12 p-1 add-row-btn">Add Row</button></td>` +
            //     `</tr>`;
            // tableBody.append(newRow);
            // rowCount++;
        }

        $(document).ready(function() {
            $('#service-details-table').on('click', '.add-row-btn', function() {
                addRow();
                $(this).closest('tr').find('.add-row-btn')
                    .remove(); // Remove the "Add Row" button from the previous row
            });

            // $('#service-details-table').on('click', '.remove-row-btn', function () {
            //     $(this).closest('tr').remove(); // Remove the entire row
            // });
        });

        // $(document).ready(function() {
        //     $('#saveWalkInCustomer').on('click', function() {
        //         $('#walkInCustomerForm').submit(); // Replace 'yourFormId' with the actual ID of your form
        //     });
        // });
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

            var addressSection = $('#addressSection').show();
            // Focus on the first input field in the address section
            var firstInput = $('#addressSection input').first();
            if (firstInput) {
                firstInput.focus();
            }
        }
    </script>
    {{-- Validate Form Script --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {
        // Add an event listener to the button
        const addButton = document.getElementById('submitServiceBtn');
        addButton.addEventListener('click', function (event) {
            // Prevent the default button click behavior
            event.preventDefault();

            // Validate the form
            if (validateForm()) {
                // If the form is valid, submit it
                const form = document.getElementById('walkInCustomerForm'); // Replace 'yourFormId' with the actual ID of your form
                form.submit();
            }
        });
    });
    $('#smsAlert').click(function () {
        // Toggle the aria-pressed attribute
        $(this).attr('aria-pressed', function (_, value) {
            // Set the value to 1 if the button is "on," otherwise set it to 0
            return value === 'false' ? 'true' : 'false';
        });

        // Get the updated value
        var smsNotificationValue = $('#smsAlert').attr('aria-pressed') === 'true' ? '1' : '0';

        // Log the value to the console (you can remove this in your actual code)
        console.log('sms_notification value:', smsNotificationValue);
        $('#smsNotification').val(smsNotificationValue);

    });
    $('#emailAlert').click(function () {
        // Toggle the aria-pressed attribute
        $(this).attr('aria-pressed', function (_, value) {
            // Set the value to 1 if the button is "on," otherwise set it to 0
            return value === 'false' ? 'true' : 'false';
        });

        // Get the updated value
        var emailNotificationValue = $('#emailAlert').attr('aria-pressed') === 'true' ? '1' : '0';

        // Log the value to the console (you can remove this in your actual code)
        console.log('email_notification value:', emailNotificationValue);
        $('#emailNotification').val(emailNotificationValue);

        
    });

        function validateForm() {
            clearErrors();
            // Flag to check if the form is valid
            let isValid = true;

            // Validate Repair Category
            const repairCategory = document.getElementById('repairCategory');
            if (repairCategory && repairCategory.selectedIndex < 0) {
                displayError('repairCategoryError', 'Please select a Repair Category.');
                isValid = false;
            }
      

            // Validate Select Device
            const selectDevice = document.getElementById('selectDevice');
            if (selectDevice && selectDevice.selectedIndex < 0) {
                displayError('selectDeviceError', 'Please select a Device.');
                isValid = false;
            }

            // Validate Device Brand
            const deviceBrand = document.querySelector('input[name="service_details[0][device_brand]"]').value;
            if (deviceBrand.trim() === '') {
                displayError('deviceBrandError', 'Please enter a Device Brand.');
                isValid = false;
            }

            // Validate Device Issue
            // const deviceIssue = document.querySelector('input[name="device_issue"]').value;
            // if (deviceIssue.trim() === '') {
            //     displayError('deviceIssueError', 'Please enter a Device Issue.');
            //     isValid = false;
            // }

            // Validate IMEI or Serial Number
            const imeiOrSerial = document.querySelector('input[name="service_details[0][imei_or_serial]"]').value;
            if (imeiOrSerial.trim() === '') {
                displayError('imeiError', 'Please enter an IMEI or Serial Number.');
                isValid = false;
            }

            // Validate Repair Time
            // const repairTime = document.querySelector('input[name="service_details[0][repair_time]"]').value;
            // if (repairTime.trim() === '') {
            //     displayError('repairTimeError', 'Please select a Repair Time.');
            //     isValid = false;
            // }

            // Validate Quantity
            // const quantity = document.querySelector('input[name="service_details[0][quantity]"]').value;
            // if (quantity.trim() === '' || quantity <= 0) {
            //     displayError('quantityError', 'Please enter a valid Quantity.');
            //     isValid = false;
            // }

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


            // Check if the "Sell Phone" option is selected
            var sellOptionSelected = document.getElementById('sellOption').checked;

            // Get the driving license input and message elements
            var drivingLicenseInput = document.getElementById('drivingLicense');
            var drivingLicenseMessage = document.getElementById('drivingLicenseMessage');

            // Set the "required" attribute based on the selected option
            drivingLicenseInput.required = sellOptionSelected;

            // Show/hide the validation message based on the "required" attribute
            if (sellOptionSelected && !drivingLicenseInput.value.trim()) {
                // If "Sell Phone" is selected and driving license is not entered
                drivingLicenseMessage.innerText = "This field is required for selling a phone.";
                event.preventDefault(); // Prevent form submission
            } else {
                drivingLicenseMessage.innerText = ""; // Clear the message
            }
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
                    alert('An error occurred while adding the issue');

                }
            });

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
