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
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
    <form id="buyPhoneForm" class="toggle_profile" method="POST" action="{{ route('phone_buy.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="customer_type" value="walk-in-by-retailer">
        <input type="hidden" name="customer_id" id="customerId">
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
                                        class="form-control mr-1" placeholder="Search Customer">
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
                                    <label for="">Customer Group</label>
                                    <input type="text" name="customer_group" id="customerGroup" placeholder=""
                                        class="form-control" value="{{ old('customer_group') }}">
                                    @error('customer_group')
                                       <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label id="name-label" for="name">First Name</label>
                                    <input type="text" name="first_name" id="customerFirstName" placeholder=""
                                        class="form-control" value="{{ old('first_name') }}">
                                    @error('first_name')
                                       <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Last Name</label>
                                    <input type="text" name="last_name" placeholder="" id="customerLastName"
                                        class="form-control" value="{{ old('last_name') }}">
                                    @error('last_name')
                                       <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label id="email-label" for="email">Email</label>
                                    <div class="d-flex">
                                        <input type="email" name="email" id="email" placeholder=""
                                            class="mr-1 form-control" value="{{ old('email') }}">
                                        {{-- <button class="btn bg-gradient-primary text-white py-0 px-3 ">+</button> --}}
                                        @error('email')
                                           <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <div class="d-flex">
                                        <input type="text" id="phone" class="form-control" placeholder="Phone Number"
                                            name="phone" value="{{ old('phone') }}">
                                        @error('phone')
                                           <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        {{-- <button class="btn bg-gradient-primary text-white py-0 px-3  ml-1">+</button> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Driving license or</label><span>any Id Proof</span>
                                 
                                    <input type="file" name="driving_license" id="drivingLicense" placeholder=""
                                        class="form-control">
                                        {{-- @if (old('driving_license'))
                                        <img src="{{ old('driving_license') }}" alt="Uploaded Image" style="max-width: 200px; max-height: 200px;">
                                         @endif --}}
                                        <div id="preview" style="display: none"></div>
                                    @error('driving_license')
                                       <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <strong>Notifications</strong>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6>Email Alert</h6>
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="hidden" name="email_notification" id="emailNotificationInput" value="1">
                                        <button type="button" name="email_notification"
                                            class="btn btn-xs btn-toggle active" id="emailAert" data-toggle="button"
                                            aria-pressed="true" autocomplete="off" onclick="toggleEmailNotification()">
                                            <div class="handle"></div>
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6>SMS Alert</h6>
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="hidden" name="sms_notification" id="smsNotificationInput" value="1">

                                        <button type="button" name="sms_notification" id="smsAlert"
                                            class="btn btn-xs btn-toggle active" data-toggle="button" aria-pressed="true"
                                            autocomplete="off" onclick="toggleSmsNotification()">
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
                                    <input type="text" name="device_model" class="form-control" value="{{ old('device_model') }}">
                                    @error('device_model')
                                       <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Device Brand</label>
                                    <input type="text" name="device_brand" class="form-control" value="{{ old('device_brand') }}">
                                    @error('device_brand')
                                       <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Imei</label>
                                    <input type="text" name="imei" class="form-control" value="{{ old('imei') }}">
                                    @error('imei')
                                       <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Buying Price</label>
                                    <input type="text" name="buying_price" class="form-control" value="{{ old('buying_price') }}">
                                    @error('buying_price')
                                       <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Selling Price</label>
                                    <input type="text" name="selling_price" class="form-control" value="{{ old('selling_price') }}">
                                    @error('selling_price')
                                       <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>



        </div>


        <div class="row mt-3">
            <div class="col-md-12 text-right">
                <input type="submit" id="saveWalkInCustomer" class="btn bg-gradient-primary text-white ">Save
                Details</button>
            </div>
        </div>

    </form>

@endsection

@push('js')
    <script>
            $(document).ready(function() {
        // Assuming 'response.driving_license' contains the file URL or base64 data
        $('#drivingLicense').change(function() {
            var file = this.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#preview').html('<img src="' + e.target.result + '" style="max-width: 200px; max-height: 200px;" alt="Driving License Preview">');
            }

            reader.readAsDataURL(file);
        });
    });
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
                    // $('#drivingLicense').val(response.driving_license);
                    var file = response.driving_license;
                    $('#preview').show();
        $('#preview').html('<img src="' + file + '" style="max-width: 200px; max-height: 200px;" alt="Driving License Preview">');




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

        function toggleEmailNotification() {
        var emailInput = document.getElementById('emailNotificationInput');
        if (emailInput.value === '1') {
            emailInput.value = '0';
        } else {
            emailInput.value = '1';
        }
    }

    function toggleSmsNotification() {
        var emailInput = document.getElementById('smsNotificationInput');
        if (emailInput.value === '1') {
            emailInput.value = '0';
        } else {
            emailInput.value = '1';
        }
    }
    </script>
@endpush
