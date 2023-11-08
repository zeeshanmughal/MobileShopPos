<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

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
                    <form id="survey-form" class="toggle_profile">
                        <div class="row ">
                            <div class="col-md-12  ">
                                <div class="accordionExample1 p-3 form-wrap">
                                    <div class="" id="headingOne">
                                        <h4 class="mb-0 row align-items-center">
                                            <div class="col-md-6" data-toggle="collapse" data-target="#collapseOne"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                <img src="{{ asset('shop_retailer/img/icon.png') }}"> <span
                                                    class="text-gray-900 pb-0 fw-bold">Walkin Customer</span>
                                            </div>
                                            {{-- <div class="col-md-6">
                                                <div class="form-group mb-0 d-flex">
                                                    <input type="text" name="" class="form-control mr-1" placeholder="Search Customer" required>
                                                    <button class="btn bg-gradient-primary text-white py-0 px-1 ">New</button>
                                                </div>
                                            </div> --}}
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="collapse show pt-4" aria-labelledby="headingOne"
                                        data-parent=".accordionExample1">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Customer Group</label>
                                                    <select id="dropdown" name="customer_group" class="form-control">
                                                        <option disabled selected value>Select</option>
                                                        <option value="individual">Student</option>
                                                        <option value="preferNo">Prefer not to say</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tax Class</label>
                                                    <select id="dropdown" name="tax_class" class="form-control">
                                                        <option disabled selected value>Select</option>
                                                        <option value="Individual">Student</option>
                                                        <option value="preferNo">Prefer not to say</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label id="name-label" for="first_name">First Name</label>
                                                    <input type="text" name="first_name" id="firstName"
                                                        placeholder="" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Last Name</label>
                                                    <input type="text" name="last_name" id="lastName" placeholder=""
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label id="email-label" for="email">Email</label>
                                                    <div class="d-flex">
                                                        <input type="email" name="email" id="email"
                                                            placeholder="" class="mr-1 form-control">
                                                        {{-- <button class="btn bg-gradient-primary text-white py-0 px-3 ">+</button> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Phone</label>
                                                    <div class="d-flex">
                                                        <input type="text" {{--  id="mobile_code" --}} class="form-control"
                                                            placeholder="Phone Number" name="phone">
                                                        {{-- <button class="btn bg-gradient-primary text-white py-0 px-3  ml-1">+</button> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Driving license</label>
                                                    <input type="text" name="driving_license" placeholder=""
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <strong>Notifications</strong>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <h6>Email Alert</h6>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <button type="button" name="email_alert"
                                                            class="btn btn-xs btn-toggle active" data-toggle="button"
                                                            aria-pressed="true" autocomplete="off">
                                                            <div class="handle"></div>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <h6>SMS Alert</h6>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <button type="button" name="sms_alert"
                                                            class="btn btn-xs btn-toggle active" data-toggle="button"
                                                            aria-pressed="true" autocomplete="off">
                                                            <div class="handle"></div>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 pt-4">
                                                {{-- <a href="#" class="text-primary font-weight-bold"><u> Add Address </u></a> --}}
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <!-- ...... -->
                            {{-- <div class="col-md-6">
                                <div class="accordionExample2 p-3 form-wrap">
                                    <div class="" id="heading2">
                                        <h4 class="mb-0 align-items-center">
                                            <div data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapseOne">                            
                                                <img src="{{ asset('shop_retailer/img/icon.png')}}"> <span class="text-gray-900 pb-0 fw-bold">Ticket Summary</span>
                                            </div>
                                        </h4>
                                    </div>
                                    <div id="collapse2" class="collapse show pt-4" aria-labelledby="heading2" data-parent=".accordionExample2">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Created On</label>
                                                    <input type="date" name="" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Location</label>
                                                    <input type="text" name="" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Last Modify</label>
                                                    <input type="text" name="" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">How did you hear about us?</label>
                                                    <input type="text" name="" class="form-control" required>
                                                </div>
                                            </div>
                                         
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <!-- ...Service Details -->

                            <div class="col-md-12 mt-3 font-14 service_details">
                                <div class="accordionExample3 p-0 form-wrap">
                                    <div class="accord-header px-3 py-2" id="heading3">
                                        <h4 class="mb-0 align-items-center">
                                            <div data-toggle="collapse" data-target="#collapse3" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <span class="text-gray-100 pb-0 fw-bold">Service Details</span>
                                            </div>
                                        </h4>
                                    </div>
                                    <div id="collapse3" class="collapse show px-3 pb-2 pt-4"
                                        aria-labelledby="heading3" data-parent=".accordionExample3">
                                        <table class="table table-bordered" id="service-details-table">
                                            <thead>
                                                <tr>
                                                    {{-- <th scope="col"><input type="checkbox" name="" id=""></th> --}}
                                                    <th scope="col">Repair Category</th>
                                                    <th scope="col">Device</th>
                                                    <th scope="col">Device issue</th>
                                                    {{-- <th scope="col">Custom Fields</th> --}}
                                                    <th scope="col">IMEI/Serial</th>
                                                    <th scope="col">Repair Status</th>
                                                    {{-- <th scope="col">Repair Time</th> --}}
                                                    {{-- <th scope="col">Assigned To</th> --}}
                                                    {{-- <th scope="col">PickUp Time</th> --}}
                                                    <th scope="col">QTY</th>
                                                    {{-- <th scope="col">Price</th> --}}
                                                    {{-- <th scope="col">Tax</th> --}}
                                                    {{-- <th scope="col">More Action</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="service-details-row">
                                                    {{-- <th scope="row"></th> --}}
                                                    <td>
                                                        <div class="form-group">
                                                            <select id="dropdown" name="service_details[0][repair_category]" class="form-control">
                                                                <option disabled selected value>Select Category</option>
                                                                <option value="Individual">Mobile</option>
                                                                <option value="preferNo">Prefer not to say</option>
                                                                <option value="other">Other</option>
                                                            </select>
                                                        </div>
                                                        {{-- <a href="#" class="text-primary">Additional Note</a> --}}
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select id="dropdown" name="service_details[0][device]"
                                                                class="form-control">
                                                                <option disabled selected value>Select Device</option>
                                                                <option value="Individual">Student</option>
                                                                <option value="preferNo">Prefer not to say</option>
                                                                <option value="other">Other</option>
                                                            </select>
                                                        </div>
                                                        {{-- <a href="#" class="text-primary">Pre-Repair Device Conditions</a> --}}
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" name="service_details[0][device_issue]"
                                                                placeholder="Select Problem" class="form-control">
                                                        </div>
                                                        {{-- <a href="#" class="text-primary">Add Diagnostic/ Internal Notes</a> --}}
                                                    </td>
                                                    {{-- <td>
                                                    <a href="#" class="text-primary">Manage Custom Fields</a>
                                                </td> --}}
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" name="service_details[0][imei_or_serial]"
                                                                placeholder="Enter IMEI Number" class="form-control">
                                                        </div>
                                                        {{-- <a href="#" class="text-primary">Serial Number</a> --}}
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" name="service_details[0][repair_status]"
                                                                class="form-control" value="pending" readonly>
                                                        </div>
                                                    </td>
                                                    {{-- <td>
                                                    <div class="form-group">
                                                        <select id="dropdown" name="role" class="form-control" >
                                                            <option disabled selected value>Select Status</option>
                                                            <option value="Individual">Student</option>
                                                            <option value="preferNo">Prefer not to say</option>
                                                            <option value="other">Other</option>
                                                        </select>
                                                    </div>
                                                    <a href="#" class="text-primary">Task Type</a>
                                                </td> --}}
                                                    {{-- <td></td> --}}
                                                    {{-- <td>
                                                    <div class="form-group">
                                                        <input type="text" name="" placeholder="Hassam Ali" class="form-control" >
                                                    </div>
                                                    <a href="#" class="text-primary"></a>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="" placeholder="" class="form-control" >
                                                    </div>
                                                    <a href="#" class="text-primary">Repaired & Collected</a>
                                                </td> --}}
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="number" name="service_details[0][quantity]"  min="1"
                                                                placeholder="1" class="form-control">
                                                        </div>
                                                        {{-- <a href="#" class="text-primary"></a> --}}
                                                    </td>
                                                    {{-- <td>
                                                    <div class="form-group">
                                                        <input type="text" name="" placeholder="" class="form-control" >
                                                    </div>
                                                    <a href="#" class="text-primary">Discount</a>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="" placeholder="" class="form-control" >
                                                    </div>
                                                    <a href="#" class="text-primary">GST Class</a>
                                                </td> --}}
                                                    <td>
                                                        <button
                                                            class="btn bg-gradient-primary text-white text-white font-12 p-1 add-row-btn">Add
                                                            Row</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-12 mt-3 font-14 service_details">
                                <div class="accordionExample4 p-0 form-wrap">
                                    <div class="accord-header px-3 py-2" id="heading4">
                                        <h4 class="mb-0 align-items-center">
                                            <div data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapseOne">                            
                                              <span class="text-gray-100 pb-0 fw-bold">Unlocking</span>
                                            </div>
                                        </h4>
                                    </div>
                                    <div id="collapse4" class="collapse show pt-4 px-3 pb-2 row" aria-labelledby="heading4" data-parent=".accordionExample4">
                                       <div class="col-md-7"></div>
                                       <div class="col-md-5">
                                            <table class="table table-bordered text-dark font-weight-bold">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Sub Total<br>  Discount<br> Tax</th>
                                                    <th scope="col">null2342342.33
                                                        <div class="form-group mb-0 py-1">
                                                            <input type="text" name="" placeholder="0.00" class="px-2 form-control" required>
                                                        </div>Null0.00</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td> Total <br> Total Paid</td>
                                                <td>Null112223.00 <br>0</td>
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
                            </div> --}}
                            <!-- --------- -->

                            {{-- <div class="col-md-12 mt-3 font-14 service_details">
                                <div class="accordionExample5 p-0 form-wrap">
                                    <div class="accord-header px-3 py-2" id="heading5">
                                        <h4 class="mb-0 align-items-center">
                                            <div data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapseOne">                            
                                              <span class="text-gray-100 pb-0 fw-bold">Service Details</span>
                                            </div>
                                        </h4>
                                    </div>
                                    <div id="collapse5" class="collapse show pt-4 px-3 pb-2" aria-labelledby="heading4" data-parent=".accordionExample5">
                                        <table class="table table-bordered">
                                            <thead>
                                              <tr>
                                                <th scope="col">Device | Repair Reference</th>
                                                <th scope="col">Item Name</th>
                                                <th scope="col">Supplier</th>
                                                <th scope="col">On Hand</th>
                                                <th scope="col">Warranty</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Unit Cost</th>
                                                <th scope="col">Line Total</th>
                                                <th scope="col">More Action</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <select id="dropdown" name="role" class="form-control" >
                                                            <option disabled selected value>Select ..</option>
                                                            <option value="Individual">Student</option>
                                                            <option value="preferNo">Prefer not to say</option>
                                                            <option value="other">Other</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="" placeholder="" class="form-control" >
                                                    </div>
                                                    <a href="#" class="text-primary">Select Item by SKU</a>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="" placeholder="" class="form-control" >
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="" placeholder="" class="form-control" >
                                                    </div>
                                                    <a href="#" class="text-primary"></a>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="" placeholder="" class="form-control" >
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="" placeholder="" class="form-control" >
                                                    </div>
                                                    <a href="#" class="text-primary"></a>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="" placeholder="" class="form-control" >
                                                    </div>
                                                </td>
                                                <td> </td>
                                                <td>
                                                    <button class="btn bg-gradient-primary text-center w-100 text-white font-12 p-1">Add Item</button>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                    </div>
                                </div>
                            </div> --}}
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12 text-right">
                                <button id="save" class="btn bg-gradient-primary text-white ">Submit
                                    Details</button>
                                {{-- <button id="saveAndAdd" class="btn bg-gray-800 text-white ">Save & add another Customer</button>
                        <button id="cancel" class="btn bg-gray-300 text-dark ">Cancel</button> --}}
                            </div>
                        </div>
                    </form>
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
    <script>
        // -----Country Code Selection
        $("#mobile_code").intlTelInput({
            initialCountry: "in",
            separateDialCode: true,
            // utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
        });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        let rowCount = 1;

        function addRow() {
            const tableBody = $('#service-details-table').find('tbody');
            let newRow = `<tr class="service-details-row">` +
                `<td><div class="form-group"><select name="service_details[${rowCount}][repair_category]" class="form-control" ><option disabled selected value>Select Category</option><option value="Individual">Student</option><option value="preferNo">Prefer not to say</option><option value="other">Other</option></select></div></td>` +
                `<td><div class="form-group"><select name="service_details[${rowCount}][device]" class="form-control"><option disabled selected value>Select Device</option><option value="apple">Apple</option><option value="samsung">Samsung</option><option value="google">Google</option></select></div></td>` +
                `<td><div class="form-group"><input type="text" name="service_details[${rowCount}][device_issue]" placeholder="" class="form-control"></div></td>` +
                `<td><div class="form-group"><input type="text" name="service_details[${rowCount}][imei_or_serial]" placeholder="Enter IMEI Number" class="form-control"></div></td>` +
                `<td><div class="form-group"><select name="service_details[${rowCount}][repair_status]" class="form-control"> <option value="pending" selected>Pending</option></select></div></td>` +
                `<td><div class="form-group"><input type="number" name="service_details[${rowCount}][quantity]" placeholder="1" min="1" class="form-control"></div></td>` +
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
        });
    </script>

</body>

</html>
