<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>WalkIn Customer</title>

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
                                                        <label for="">Device Name</label>
                                                        <input list="device_names"
                                                            name="service_details[0][device_name]"
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


                                                {{-- <a href="#" class="text-primary">Additional Note</a>  --}}


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="deviceIssue">Device Issue</label>
                                                        <div id="searchIssueContainer" class="position-relative">
                                                            <div class="input-group">
                                                                <input type="text"
                                                                    name="service_details[0][device_issue]"
                                                                    class="form-control" id="deviceIssue"
                                                                    oninput="searchDeviceIssue()" autocomplete="off">
                                                                <div class="input-group-append">
                                                                    <button
                                                                        class="btn bg-gradient-primary text-white py-0 px-3 "
                                                                        onclick="openConfirmModal(event)"
                                                                        data-toggle="tooltip"
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
                                                        <input type="text" name="service_details[0][description]"
                                                            class="form-control">
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
                                                        <label for="">Mobile Pin</label>

                                                        <input type="text" name="service_details[0][mobile_pin]"
                                                            placeholder="Enter Mobile Pin" class="form-control">
                                                        <div id="mobilePinError" class="error-message"></div>

                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Repair Status</label>

                                                        <select id="dropdown"
                                                            name="service_details[0][repair_status]"
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
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Quantity</label>

                                                        <input type="number" name="service_details[0][quantity]"
                                                            min="1" placeholder="0" class="form-control"
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

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Country Code</label>
                                                        <input type="text" name="country_code" id="countryCode"
                                                            class="form-control makeDisable" value="+44">
                                                    </div>
                                                    <div id="countryCodeError" class="error-message"></div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Phone</label>
                                                        <div class="d-flex">
                                                            <input type="text" id="mobilePhone"
                                                                class="form-control" placeholder="Phone Number"
                                                                name="phone">

                                                        </div>
                                                        <div id="phoneError" class="error-message"></div>

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
                                                    <div class="form-group Picture_2">
                                                        <label for="">Driving License or <small>(any id
                                                                proof)</small> </label>
                                                        <div class="d-flex">
                                                            <img id="drivingLicensePreview"
                                                                src="https://placehold.it/180"
                                                                class="blah mr-1 previewImage" alt="Id Proof Image" />
                                                            <input type='file' name="driving_license"
                                                                class="form-control" id="drivingLicense"
                                                                accept="image/*"
                                                                onchange="readURL(this, 'drivingLicensePreview');" />
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <strong>Notifications</strong>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <div
                                                                    class="custom-control custom-checkbox custom-control-inline">
                                                                    <input type="checkbox"
                                                                        class="custom-control-input"
                                                                        name="sms_notification"
                                                                        id="smsNotificationCheckbox">
                                                                    <label class="custom-control-label"
                                                                        for="smsNotificationCheckbox">SMS
                                                                        Notifications</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <div
                                                                    class="custom-control custom-checkbox custom-control-inline">
                                                                    <input type="checkbox"
                                                                        class="custom-control-input"
                                                                        name="email_notification"
                                                                        id="emailNotificationCheckbox">
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

                                       
                                            {{-- <div class="mt-4">
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
                                            </div> --}}
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
                <div class="modal fade" id="confirmIssueModal" tabindex="-1" role="dialog"
                    aria-labelledby="confirmModalLabel" aria-hidden="true">
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
                                <button type="button" class="btn btn-primary"
                                    onclick="addNewIssue(event)">Confirm</button>
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
    {{-- <script src="{{ retailer_asset('vendor/chart.js/Chart.min.js') }}"></script> --}}

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <script>
                  document.addEventListener("DOMContentLoaded", function() {
        
        var countryCodeInput = document.getElementById('countryCode');

            Inputmask(countryCode + ' 9999 999999').mask(document.getElementById('mobilePhone'));

            Inputmask({
                mask: '+999',
                placeholder: '',
                definitions: {
                    '9': {
                        validator: '[0-9]',
                        cardinality: 1
                    }
                }
            }).mask(countryCodeInput);

         

            // Attach an event listener to update the mask when the country code changes
            countryCodeInput.addEventListener('input', function() {
                Inputmask(' 9999 999999').mask(document.getElementById(
                    'mobilePhone'));
            });

              
    });
    
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#searchIssueContainer').length) {
                $('#searchIssueResults').empty();
            }
        });
        function readURL(input, previewId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById(previewId).src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

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
                }else {
                    document.documentElement.scrollTop = 0;
                }
            });
        });


        function validateForm() {
            clearErrors();
            // Flag to check if the form is valid
            let isValid = true;

        

            // Validate Select Device
            const selectDevice = document.getElementById('selectDevice');
            if (selectDevice && selectDevice.selectedIndex < 0) {
                displayError('selectDeviceError', 'Please select a Device.');
                isValid = false;
            }

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
            
            // Validate Quantity
            const quantity = document.querySelector('input[name="service_details[0][quantity]"]').value;
            if (quantity.trim() === '' || quantity <= 0) {
                displayError('quantityError', 'Please enter a valid Quantity.');
                isValid = false;
            }

            const issueId = document.getElementById('issueId').value;
            if (issueId.trim() === '') {
                displayError('deviceIssueError', 'Please select device issue.');
                isValid = false;
            }

            const firstName = document.querySelector('input[name="first_name"]').value;
            if (firstName.trim() === '') {
                displayError('firstNameError', 'Please enter first name.');
                isValid = false;
            }

            const lastName = document.querySelector('input[name="last_name"]').value;
            if (lastName.trim() === '') {
                displayError('lastNameError', 'Please enter last name.');
                isValid = false;
            }

            const email = document.querySelector('input[name="email"]').value;
            if (email.trim() === '') {
                displayError('emailError', 'Please enter email.');
                isValid = false;
            } else if (!isValidEmail(email)) {

                displayError('emailError', 'Please enter email with correct format.');
                isValid = false;
            }

            const countryCode = document.querySelector('input[name="country_code"]').value;
            if (countryCode.trim() === '') {
                displayError('countryCodeError', 'Please enter phone number.');
                isValid = false;
            }

            const phone = document.querySelector('input[name="phone"]').value;
            if (phone.trim() === '') {
                displayError('phoneError', 'Please enter phone number.');
                isValid = false;
            }
     
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
                    console.log('response = =' + response);
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
