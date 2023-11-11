@extends('layouts.retailer')
@push('styles')
    <style>
        .search-results {
            position: absolute;
            top: 42px;
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
    <form id="walkInCustomerForm" class="toggle_profile" method="POST" action="{{ route('service-detail.store') }}">
        @csrf
        <input type="hidden" name="customer_type" value="walk-in-by-retailer">
        <input type="hidden" name="customer_id" id="customerId">
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
                                {{-- <div class="form-group mb-0 d-flex" id="searchContainer">
                                    <input type="text" name="search_customer" id="searchCustomerInput"
                                        class="form-control mr-1" placeholder="Search Customer">
                                    <div id="searchResults" class="search-results"></div>

                                    <button class="btn bg-gradient-primary text-white py-0 px-1 "
                                        onclick="window.location.href = '{{ route('customer.create') }}'">New</button>
                                </div> --}}
                            </div>
                        </h4>
                    </div>
                    <div id="" class=" show pt-4" aria-labelledby="headingOne" data-parent=".accordionExample1">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Repair Category</label>
                                    <select id="dropdown" name="service_details[0][repair_category]" id="repairCategory"
                                        class="form-control">
                                        <option disabled selected value>Select</option>
                                        <option value="Individual">Student</option>
                                        <option value="preferNo">Prefer not to say</option>
                                        <option value="other">Other</option>
                                    </select>

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
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Device Brand</label>
                                    <input type="text" name="service_details[0][device_brand]" placeholder=""
                                    class="form-control">
                                  
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{-- <a href="#" class="text-primary">Pre-Repair Device Conditions</a> --}}

                                <div class="form-group">
                                    <label for="">Device Issue</label>

                                    <input type="text" name="service_details[0][device_issue]" placeholder=""
                                        class="form-control">
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
                                </div>
                            </div>
                            {{-- <a href="#" class="text-primary">Serial Number</a> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Repair Status</label>

                                    <select id="dropdown" name="service_details[0][repair_status]" class="form-control">
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
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Assigned To</label>

                                    <input type="text" name="service_details[0][assigned_to]" placeholder="Hassam Ali"
                                        disabled class="form-control">
                                </div>
                            </div>
                            {{-- <a href="#" class="text-primary"></a> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Pickup Time</label>

                                    <input type="date" name="service_details[0][pickup_time]" placeholder=""
                                        class="form-control">
                                </div>
                            </div>
                            {{-- <a href="#" class="text-primary">Repaired & Collected</a> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Quantity</label>

                                    <input type="number" name="service_details[0][quantity]" min="1" placeholder="1"
                                        class="form-control">
                                </div>
                            </div>
                            {{-- <a href="#" class="text-primary"></a> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Price</label>

                                    <input type="number" name="service_details[0][price]" placeholder="" min="0"
                                        class="form-control">
                                </div>
                            </div>
                            {{-- <a href="#" class="text-primary">Discount</a> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Tax <small>%</small></label>

                                    <input type="number" name="service_details[0][tax]" min="0" placeholder=""
                                        class="form-control">
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
                                    <div id="searchResults" class="search-results"></div>

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
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Last Name</label>
                                    <input type="text" name="last_name" placeholder="" id="customerLastName"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label id="email-label" for="email">Email</label>
                                    <div class="d-flex">
                                        <input type="email" name="email" id="email" placeholder=""
                                            class="mr-1 form-control" required>
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
                                    <input class="form-check-input" type="radio" name="action" id="repairOption" value="repair" checked>
                                    <label class="form-check-label" for="repairOption">
                                        Repair Phone
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="action" id="sellOption" value="sell">
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
                                            class="btn btn-xs btn-toggle active" id="emailAert" data-toggle="button"
                                            aria-pressed="false" autocomplete="off">
                                            <div class="handle"></div>
                                        </button>
                                    </div>

                                    <div class="col-sm-3">
                                        <h6>SMS Alert</h6>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="button" name="sms_notification" id="smsAlert"
                                            class="btn btn-xs btn-toggle active" data-toggle="button" aria-pressed="false"
                                            autocomplete="off">
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
                                    <input type="text" name="street_address"id="streetAddress" class="form-control">
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
                                    <input type="date" name="created_on" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Location</label>
                                    <input type="text" name="location" class="form-control" required>
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
                                                <input type="text" name="bill_discount" id="billDiscount"
                                                    placeholder="0.00" class="px-2 form-control">
                                            </div>
                                            <p id="billTax">0.00</p>
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
                                            <p>0</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Due</td>
                                        <td>null112233.00</td>
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
                <button id="" class="btn bg-gradient-primary text-white " onclick="validateForm(event)" >Save Customer Service
                    Details</button>
                {{-- <button id="saveWalkInCustomer" class="btn bg-gradient-primary text-white " >Save Customer Service
                    Details</button> --}}
                {{-- <button id="saveAndAdd" class="btn bg-gray-800 text-white ">Save & add another Customer</button>
                <button id="cancel" class="btn bg-gray-300 text-dark ">Cancel</button> --}}
            </div>
        </div>

    </form>
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
                    $('#customerGroup').val(response.customer_group);
                    $('#phone').val(response.phone);
                    $('#drivingLicense').val(response.driving_license);




                    $('#email').val(response.email);
                    // Add other fields as needed
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
    </script>
    <script>
        let rowCount = 1;

        function addRow() {
            const tableBody = $('#service-details-table').find('tbody');
            let newRow = `<tr class="service-details-row">` +
                `<th scope="row"></th>` +
                `<td><div class="form-group"><select name="service_details[${rowCount}][repair_category]" class="form-control" ><option disabled selected value>Select Category</option><option value="Individual">Student</option><option value="preferNo">Prefer not to say</option><option value="other">Other</option></select></div></td>` +
                `<td><div class="form-group"><select name="service_details[${rowCount}][device]" class="form-control"><option disabled selected value>Select Device</option><option value="apple">Apple</option><option value="samsung">Samsung</option><option value="google">Google</option></select></div></td>` +
                `<td><div class="form-group"><input type="text" name="service_details[${rowCount}][device_issue]" placeholder="" class="form-control"></div></td>` +
                `<td><div class="form-group"><input type="text" name="service_details[${rowCount}][imei_or_serial]" placeholder="Enter IMEI Number" class="form-control"></div></td>` +
                `<td><div class="form-group"><select name="service_details[${rowCount}][repair_status]" class="form-control"> <option value="pending" selected>Pending</option></select></div></td>` +
                `<td><div class="form-group"><input type="date" name="service_details[${rowCount}][repair_time]" class="form-control"></div></td>` +
                `<td><div class="form-group"><input type="text" name="service_details[${rowCount}][assigned_to]" placeholder="Hassam Ali" class="form-control" disabled></div></td>` +
                `<td><div class="form-group"><input type="date" name="service_details[${rowCount}][pickup_time]" placeholder="" class="form-control"></div></td>` +
                `<td><div class="form-group"><input type="number" name="service_details[${rowCount}][quantity]" placeholder="1" min="1" class="form-control"></div></td>` +
                `<td><div class="form-group"><input type="number" name="service_details[${rowCount}][price]" placeholder="" min="0" class="form-control" "></div></td>` +
                `<td><div class="form-group"><input type="number" name="service_details[${rowCount}][tax]" placeholder="" min="0" class="form-control"></div></td>` +
                `<td><button class="btn bg-gradient-primary text-white text-white font-12 p-1 add-row-btn">Add Row</button></td>` +
                `</tr>`;
            tableBody.append(newRow);
            rowCount++;
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

        $(document).ready(function() {
            $('#saveWalkInCustomer').on('click', function() {
                $('#walkInCustomerForm').submit(); // Replace 'yourFormId' with the actual ID of your form
            });
        });

        // Function to update the total price
        function updateTotal() {
            let subtotal = 0;
            let priceGreaterThanZero = false;
            $('tr.service-details-row').each(function() {
                console.log('noo');
                const price = parseFloat($(this).find('input[name^="service_details"][name$="[price]"]').val()) ||
                    0;
                console.log('price+++', price);
                const quantity = parseFloat($(this).find('input[name^="service_details"][name$="[quantity]"]')
                    .val()) || 1;
                console.log('quantity+++', quantity);

                const rowTotal = price * quantity;
                $(this).find('.row-total').text(rowTotal.toFixed(2));
                if (price > 0) {
                    priceGreaterThanZero = true;
                }
                subtotal += rowTotal;
            });

            let discount = parseFloat($('#discount').val()) || 0;
            let tax = parseFloat($('#tax').val()) || 0;

            // Calculate the total after applying the discount
            let total = subtotal - discount;
            if (total < 0) {
                total = 0;
            }
            console.log('subtotal +++', subtotal);
            console.log('total +++', total);

            // Display the subtotal, total, and other details in specific elements on the page
            $('#subTotal').text(subtotal.toFixed(2)); // Assuming you have an element with the ID 'subtotal'
            $('#totalPrice').text(total.toFixed(2)); // Assuming you have an element with the ID 'total'
        }


        // Event listeners for the inputs
        $('body').on('input',
            'input[name^="service_details"][name$="[price]"], input[name^="service_details"][name$="[quantity]"], #discount, #tax',
            function() {
                updateTotal
                    (); // Call the updateTotal function whenever the price, quantity, discount, or tax values change
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
    <script>
        function validateForm(event) {
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
    </script>
@endpush
