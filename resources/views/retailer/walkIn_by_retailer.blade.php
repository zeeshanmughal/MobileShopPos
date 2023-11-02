@extends('layouts.retailer')

@section('content')

<form id="survey-form" class="toggle_profile">
    @csrf
    <input type="hidden" name="customer_type" value="walk-in">
    <div class="row ">
        <div class="col-md-6 ">
            <div class="accordionExample1 p-3 form-wrap">
                <div class="" id="headingOne">
                    <h4 class="mb-0 row align-items-center">
                        <div class="col-md-6" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">                            
                            <img src="{{ retailer_asset('img/icon.png') }}"> <span class="text-gray-900 pb-0 fw-bold">Walkin Customer</span>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0 d-flex" id="searchContainer">
                                <input type="text" name="search_customer" id="searchCustomerInput" class="form-control mr-1" placeholder="Search Customer" required>
                                
                                <button class="btn bg-gradient-primary text-white py-0 px-1 ">New</button>
                            </div>
                        </div>
                    </h4>
                </div>
                <div id="collapseOne" class="collapse show pt-4" aria-labelledby="headingOne" data-parent=".accordionExample1">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Customer Group</label>
                                <input type="text" name="customer_group" placeholder="" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tax Class</label>
                                <select id="dropdown" name="tax_class" class="form-control" required>
                                    <option disabled selected value>Select</option>
                                    <option value="Individual">Student</option>
                                    <option value="preferNo">Prefer not to say</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label id="name-label" for="name">First Name</label>
                                <input type="text" name="first_name" id="name" placeholder="" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Last Name</label>
                                <input type="text" name="last_name" placeholder="" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label id="email-label" for="email">Email</label>
                                <div class="d-flex">
                                    <input type="email" name="email" id="email" placeholder="" class="mr-1 form-control" required>
                                    <button class="btn bg-gradient-primary text-white py-0 px-3 ">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="">Phone</label>
                                <div class="d-flex">
                                    <input type="text" id="mobile_code" class="form-control" placeholder="Phone Number" name="phone">
                                    <button class="btn bg-gradient-primary text-white py-0 px-3  ml-1">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Driving license</label>
                                <input type="text" name="driving_license" placeholder="" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <strong>Notifications</strong>
                            <div class="row">
                              <div class="col-sm-3">
                                  <h6>Email Alert</h6>
                              </div>
                              <div class="col-sm-5">
                                  <button type="button" name="email_notification" class="btn btn-xs btn-toggle active" data-toggle="button" aria-pressed="true" autocomplete="off">
                                  <div class="handle"></div>
                                  </button>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-3">
                                  <h6>SMS Alert</h6>
                              </div>
                              <div class="col-sm-5">
                                  <button type="button" name="sms_notification" class="btn btn-xs btn-toggle active" data-toggle="button" aria-pressed="true" autocomplete="off">
                                  <div class="handle"></div>
                                  </button>
                              </div>
                            </div>
                        </div>
                        <div class="col-md-12 pt-4">
                            <a href="#" class="text-primary font-weight-bold"><u> Add Address </u></a>
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
                        <div data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapseOne">                            
                            <img src="{{ retailer_asset('img/icon.png') }}"> <span class="text-gray-900 pb-0 fw-bold">Ticket Summary</span>
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
                                <input type="text" name="location" class="form-control" required>
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
                                <input type="text" name="how_did_you_hear_us" class="form-control" required>
                            </div>
                        </div>
                     
                    </div>
                </div>
            </div>
        </div>
        <!-- ...Service Details -->
        
        <div class="col-md-12 mt-3 font-14 service_details">
            <div class="accordionExample3 p-0 form-wrap">
                <div class="accord-header px-3 py-2" id="heading3">
                    <h4 class="mb-0 align-items-center">
                        <div data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapseOne">                            
                          <span class="text-gray-100 pb-0 fw-bold">Service Details</span>
                        </div>
                    </h4>
                </div>
                <div id="collapse3" class="collapse show px-3 pb-2 pt-4" aria-labelledby="heading3" data-parent=".accordionExample3">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                              <th scope="col"><input type="checkbox" name="" id=""></th>
                            <th scope="col">Repair Category</th>
                            <th scope="col">Device</th>
                            <th scope="col">Device issue</th>
                            <th scope="col">Custom Fields</th>
                            <th scope="col">IMEI/Serial</th>
                            <th scope="col">Repair Status</th>
                            <th scope="col">Repair Time</th>
                            <th scope="col">Assigned To</th>
                            <th scope="col">PickUp Time</th>
                            <th scope="col">QTY</th>
                            <th scope="col">Price</th>
                            <th scope="col">Tax</th>
                            <th scope="col">More Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row"></th>
                            <td>
                                <div class="form-group">
                                    <select id="dropdown" name="repair_category" class="form-control" required>
                                        <option disabled selected value>Select Category</option>
                                        <option value="Individual">Student</option>
                                        <option value="preferNo">Prefer not to say</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <a href="#" class="text-primary">Additional Note</a>
                            </td>
                            <td>
                                <div class="form-group">
                                    <select id="dropdown" name="device" class="form-control" >
                                        <option disabled selected value>Select Device</option>
                                        <option value="Individual">Student</option>
                                        <option value="preferNo">Prefer not to say</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <a href="#" class="text-primary">Pre-Repair Device Conditions</a>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" name="device_issue" placeholder="" class="form-control" >
                                </div>
                                <a href="#" class="text-primary">Add Diagnostic/ Internal Notes</a>
                            </td>
                            <td>
                                <a href="#" class="text-primary">Manage Custom Fields</a>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" name="imei_or_serial" placeholder="Enter IMEI Number" class="form-control" >
                                </div>
                                <a href="#" class="text-primary">Serial Number</a>
                            </td>
                            <td>
                                <div class="form-group">
                                    <select id="dropdown" name="repair_status" class="form-control" >
                                        <option disabled selected value>Select Status</option>
                                        <option value="Individual">Student</option>
                                        <option value="preferNo">Prefer not to say</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <a href="#" class="text-primary">Task Type</a>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="date" name="repair_time" class="form-control">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" name="assigned_to" placeholder="Hassam Ali" class="form-control" >
                                </div>
                                <a href="#" class="text-primary"></a>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" name="pickup_time" placeholder="" class="form-control" >
                                </div>
                                <a href="#" class="text-primary">Repaired & Collected</a>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" name="quantity" placeholder="" class="form-control" >
                                </div>
                                <a href="#" class="text-primary"></a>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" name="price" placeholder="" class="form-control" >
                                </div>
                                <a href="#" class="text-primary">Discount</a>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" name="tax" placeholder="" class="form-control" >
                                </div>
                                <a href="#" class="text-primary">GST Class</a>
                            </td>
                            <td>
                                <button class="btn bg-gradient-primary text-white text-white font-12 p-1">Add Row</button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3 font-14 service_details">
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
        </div>
        <!-- --------- -->
        
        <div class="col-md-12 mt-3 font-14 service_details">
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
        </div>
    </div>
    
</form>

@endsection

@push('js')
<script>
  $(document).ready(function() {
    $("#searchContainer").on("click", function() {
            $("#searchCustomerInput").on("input", function() {
                var searchValue = $(this).val();

                if (searchValue.length > 0) {
                    $.ajax({
                        type: "POST",
                        url: "/search-customer",
                        data: {
                            search: searchValue,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            var selectElement = $("<select></select>").attr("id", "searchCustomer").addClass("form-control mr-1");
                            // $("#searchCustomerInput").replaceWith(selectElement);

                            selectElement.append("<option value=''>Select a customer</option>");

                            if (response.length > 0) {
                                $.each(response, function(index, item) {
                                    selectElement.append("<option value='" + item.id + "'>" + item.first_name + "</option>");
                                });
                            }

                            selectElement.on("change", function() {
                                var selectedCustomerId = $(this).val();

                                // Make an AJAX request to retrieve the customer data based on the selected ID
                                $.ajax({
                                    type: "GET",
                                    url: "/customer/" + selectedCustomerId, // Replace with your endpoint
                                    success: function(response) {
                                        $("#customerForm").show();
                                        // Populate the form with the retrieved customer data
                                        $("#first_name").val(response.first_name);
                                        // Populate more fields as needed
                                    }
                                });
                            });
                        }
                    });
                }
            });
        });
        });
</script>
@endpush