<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SB Admin 2 - Blank</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('shop_retailer/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('shop_retailer/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('shop_retailer/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
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
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <div style="margin: 60px">
                </div>

                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <form method="POST" action="{{ route('walkInServiceDetail.store') }}" id="walkInCustomerForm"
                        class="toggle_profile" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="customer_type" value="walk-in-customer">
                        {{-- <input type="hidden" name="customer_id" id="customerId"> --}}
                        <input type="hidden" name="service_details[0][device_issue_id]" id="issueId">
                        <input type="hidden" name="email_notification" id="emailNotification">
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
                                                        <select id="dropdown"
                                                            name="service_details[0][repair_category]"
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

                                                        <select id="dropdown" name="service_details[0][device]"
                                                            class="form-control">
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
                                                        <input type="text" name="service_details[0][device_brand]"
                                                            placeholder="" class="form-control">
                                                        <div id="deviceBrandError" class="error-message"></div>

                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="deviceIssue">Device Issue</label>
                                                        <div id="searchIssueContainer" class="position-relative">
                                                            <div class="input-group">
                                                                <input type="text" name="device_issue"
                                                                    class="form-control" id="deviceIssue"
                                                                    oninput="searchDeviceIssue()">
                                                                <div class="input-group-append">
                                                                    <button
                                                                        class="btn bg-gradient-primary text-white py-0 px-3 "
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




                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Imei or Serial number</label>

                                                        <input type="text"
                                                            name="service_details[0][imei_or_serial]"
                                                            placeholder="Enter IMEI Number" class="form-control">
                                                        <div id="imeiError" class="error-message"></div>

                                                    </div>
                                                </div>



                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Quantity</label>

                                                        <input type="number" name="service_details[0][quantity]"
                                                            min="1" placeholder="1" class="form-control"
                                                            id="quantity">
                                                        <div id="quantityError" class="error-message"></div>

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
                                                {{-- <div class="col-md-6">
                                    <div class="form-group mb-0 d-flex" id="searchContainer">
                                        <input type="text" name="search_customer" id="searchCustomerInput"
                                            class="form-control mr-1" placeholder="Search Customer">
                                        <div id="searchCustomerResults" class="search-results"></div>

                                        <button class="btn bg-gradient-primary text-white py-0 px-1 "
                                            onclick="window.location.href = '{{ route('customer.create') }}'">New</button>
                                    </div>
                                </div> --}}
                                            </h4>
                                        </div>
                                        <div id="" class=" show pt-4" aria-labelledby="headingOne"
                                            data-parent=".accordionExample1">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Customer Group</label>
                                                        <input type="text" name="customer_group"
                                                            id="customerGroup" placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Change Carriers</label>
                                                        <input type="text" name="change_carrier"
                                                            id="changeCarrier" placeholder="" class="form-control">
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
                                                        <input type="text" name="first_name"
                                                            id="customerFirstName" placeholder=""
                                                            class="form-control">
                                                        <div id="firstNameError" class="error-message"></div>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Last Name</label>
                                                        <input type="text" name="last_name" placeholder=""
                                                            id="customerLastName" class="form-control">
                                                        <div id="lastNameError" class="error-message"></div>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label id="email-label" for="email">Email</label>
                                                        <div class="d-flex">
                                                            <input type="email" name="email" id="email"
                                                                placeholder="" class="mr-1 form-control">

                                                        </div>
                                                        <div id="emailError" class="error-message"></div>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Phone</label>
                                                        <div class="d-flex">
                                                            <input type="text" id="phone" class="form-control"
                                                                placeholder="Phone Number" name="phone">

                                                        </div>
                                                        <div id="phoneError" class="error-message"></div>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    {{-- <label for="">Action</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="action"
                                                            id="repairOption" value="repair" checked>
                                                        <label class="form-check-label" for="repairOption">
                                                            Repair Phone
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="action"
                                                            id="sellOption" value="sell">
                                                        <label class="form-check-label" for="sellOption">
                                                            Sell Phone
                                                        </label>
                                                    </div> --}}
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Driving license</label>
                                                        <input type="text" name="driving_license"
                                                            id="drivingLicense" placeholder="" class="form-control">
                                                        <small id="drivingLicenseMessage" class="text-danger"></small>
                                                        <div id="drivingLicenseError" class="error-message"></div>

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
                                                                class="btn btn-xs btn-toggle active" id="emailAlert"
                                                                data-toggle="button" aria-pressed="false"
                                                                autocomplete="off">
                                                                <div class="handle"></div>
                                                            </button>
                                                        </div>

                                                        <div class="col-sm-3">
                                                            <h6>SMS Alert</h6>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <button type="button" name="sms_notification"
                                                                id="smsAlert" class="btn btn-xs btn-toggle active"
                                                                data-toggle="button" aria-pressed="false"
                                                                autocomplete="off">
                                                                <div class="handle"></div>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 pt-4">
                                                    <a href="#" class="text-primary font-weight-bold"
                                                        onclick="showAddressFields(event)"><u>
                                                            <strong> Add Address <small>optional</small></strong>
                                                        </u></a>
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
                                                        <input type="text" name="house_number" id="houseNumber"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">City</label>
                                                        <input type="text" name="city" id="city"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">State</label>
                                                        <input type="text" name="state" id="state"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">PostCode</label>
                                                        <input type="text" name="postcode" id="postcode"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Country</label>
                                                        <input type="text" name="country" id="country"
                                                            class="form-control">
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






                            </div>


                            <div class="row mt-3">
                                <div class="col-md-12 text-right">
                                    <button type="submit" id="submitServiceBtn"
                                        class="btn bg-gradient-primary text-white ">Save
                                        Customer Service
                                        Details</button>
                                    {{-- <button id="saveWalkInCustomer" class="btn bg-gradient-primary text-white " >Save Customer Service
                    Details</button> --}}
                                    {{-- <button id="saveAndAdd" class="btn bg-gray-800 text-white ">Save & add another Customer</button>
                <button id="cancel" class="btn bg-gray-300 text-dark ">Cancel</button> --}}
                                </div>
                            </div>

                    </form>
                </div>
                
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
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn bg-gradient-primary text-white" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('shop_retailer/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('shop_retailer/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('shop_retailer/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('shop_retailer/js/sb-admin-2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
  <script src="{{ retailer_asset('vendor/chart.js/Chart.min.js') }}"></script>

    <script>
        // -----Country Code Selection
        $("#mobile_code").intlTelInput({
            initialCountry: "in",
            separateDialCode: true,
            // utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
        });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#searchIssueContainer').length) {
                $('#searchIssueResults').empty();
            }
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
                            'walkInCustomerForm'); // Replace 'yourFormId' with the actual ID of your form
                            form.submit();
                        }
                    });
                });

                    $('#smsAlert').click(function() {
                        // Toggle the aria-pressed attribute
                        $(this).attr('aria-pressed', function(_, value) {
                            // Set the value to 1 if the button is "on," otherwise set it to 0
                            return value === 'false' ? 'true' : 'false';
                        });

                        // Get the updated value
                        var smsNotificationValue = $('#smsAlert').attr('aria-pressed') === 'true' ? '1' : '0';

                        // Log the value to the console (you can remove this in your actual code)
                        console.log('sms_notification value:', smsNotificationValue);
                        $('#smsNotification').val(smsNotificationValue);

                    });
                    $('#emailAlert').click(function() {
                        // Toggle the aria-pressed attribute
                        $(this).attr('aria-pressed', function(_, value) {
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
                        const imeiOrSerial = document.querySelector('input[name="service_details[0][imei_or_serial]"]')
                            .value;
                        if (imeiOrSerial.trim() === '') {
                            displayError('imeiError', 'Please enter an IMEI or Serial Number.');
                            isValid = false;
                        }

                        const issueId = document.getElementById('issueId').value;
                        if (issueId.trim() === '') {
                            displayError('deviceIssueError', 'Please select device issue.');
                            isValid = false;
                        }

                        const firstName = document.querySelector('input[name="first_name"]').value;
                        if(firstName.trim()===''){
                            displayError('firstNameError', 'Please enter first name.');
                            isValid = false;
                        }

                        const lastName = document.querySelector('input[name="last_name"]').value;
                        if(lastName.trim()===''){
                            displayError('lastNameError', 'Please enter last name.');
                            isValid = false;
                        }

                        const email = document.querySelector('input[name="email"]').value;
                        if(email.trim()===''){
                            displayError('emailError', 'Please enter email.');
                            isValid = false;
                        }
                        else if(!isValidEmail(email)){

                            displayError('emailError', 'Please enter email with correct format.');
                            isValid = false;
                        }

                        const phone = document.querySelector('input[name="phone"]').value;
                        if(phone.trim()===''){
                            displayError('phoneError', 'Please enter phone number.');
                            isValid = false;
                        }
                        // else if(!isValidPhoneNumber(phone)){
                        //     displayError('phoneError', 'Please enter correct phone number.');
                        //     isValid = false;
                        // }

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
                        // const price = document.querySelector('input[name="service_details[0][price]"]').value;
                        // if (price.trim() === '' || price < 0) {
                        //     displayError('priceError', 'Please enter a valid Price.');
                        //     isValid = false;
                        // }

                        // Validate Tax Percentage
                        // const taxPercentage = document.querySelector('input[name="service_details[0][tax]"]').value;
                        // if (taxPercentage.trim() === '' || taxPercentage < 0) {
                        //     displayError('taxError', 'Please enter a valid Tax Percentage.');
                        //     isValid = false;
                        // }

                        // Return the result of form validation
                        return isValid;


                        // Check if the "Sell Phone" option is selected
                        // var sellOptionSelected = document.getElementById('sellOption').checked;

                        // // Get the driving license input and message elements
                        // var drivingLicenseInput = document.getElementById('drivingLicense');
                        // var drivingLicenseMessage = document.getElementById('drivingLicenseMessage');

                        // Set the "required" attribute based on the selected option
                        // drivingLicenseInput.required = sellOptionSelected;

                        // // Show/hide the validation message based on the "required" attribute
                        // if (sellOptionSelected && !drivingLicenseInput.value.trim()) {
                        //     // If "Sell Phone" is selected and driving license is not entered
                        //     drivingLicenseMessage.innerText = "This field is required for selling a phone.";
                        //     event.preventDefault(); // Prevent form submission
                        // } else {
                        //     drivingLicenseMessage.innerText = ""; // Clear the message
                        // }
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
                    console.log('response = ='+response);
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
</body>

</html>
