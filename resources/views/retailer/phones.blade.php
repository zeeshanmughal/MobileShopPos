@extends('layouts.retailer')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-end">
            <form action="{{ route('phone.search') }}" method="POST">
                @csrf
                <div class="row mb-5">
                    <div class="col-md-8">
                        <label for="phoneModel" style="display: inline-block;">Phone Label/Model:</label>
                        <input type="text" name="search_input" class="form-control"
                            value="{{ isset($searchInput) ? $searchInput : '' }}" style="display: inline-block;">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary"
                            style="display: inline-block; margin-top:30px;">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="card" id="phoneDetailCard" style="display: none;">
        <div class="card-body">
            <h4 class="card-title"><strong> Phone Details</strong></h4>
            <form id="phoneSellForm"  method="POST" action="{{ route('phone_sell.store') }}">
                @csrf
                <input type="hidden" name="phone_id" id="phoneId">
                <div class="row">
                    <div class="col-md-6">
                        <li class="list-group-item"><strong>Device Model:</strong>
                            <p id="deviceModelText" style="display: inline;"> </p>
                        </li>
                        <input type="hidden" name="device_model" id="deviceModel" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <li class="list-group-item"><strong>Device Brand:</strong>
                            <p id="deviceBrandText" style="display: inline;"> </p>
                        </li>

                        <input type="hidden" name="device_brand" id="deviceBrand" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <li class="list-group-item"><strong>Imei:</strong>
                            <p id="deviceImeiText" style="display: inline;"> </p>
                        </li>

                        <input type="hidden" name="imei" id="imei" class="form-control">

                    </div>
                    <div class="col-md-6">
                        <li class="list-group-item"><strong>Selling Price:</strong>
                            <p id="sellingPriceText" style="display: inline;"> </p>
                        </li>

                        <input type="hidden" name="selling_price" id="sellingPrice" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="discount"><strong>Discount</strong></label>
                        <input type="text" name="discount" id="discountInput" class="form-control"
                            style="display: inline;">
                        <span id="discountError" style="color: red;"></span>

                    </div>
                    <div class="col-md-6">
                        <li class="list-group-item"><strong>Totoal Price:</strong>
                            <p id="totalPriceText" style="display: inline;"> </p>
                        </li>

                        <input type="hidden" name="total_price" id="totalPrice" class="form-control"
                            style="display: inline">
                    </div>



                </div>
                <div class="row justify-content-end mr-4">
                    <a href="#" class="btn btn-primary" id="payByCashBtn">Pay By Cash</a>
                    <div></div>
                    <a href="#" class="btn btn-primary" id="payByCardBtn">Pay By Card</a>

                </div>
            </form>
        </div>
    </div>





    <div class="mt-4">
        @if (count($phones) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <h4><strong>Phones list</strong></h4>
                        </th>
                    </tr>
                </thead>
                <tr>
                    <th>Device Model</th>
                    <th>Device Brand</th>
                    <th>Imei</th>
                    <th>Buying Price</th>
                    <th>Selling Price</th>

                    <th>Actions</th>
                    {{-- <th>Customer Group</th> --}}

                    <!-- Add more table headers here as needed -->
                </tr>
                @foreach ($phones as $p => $phone)
                    <tr>
                        <td>{{ $phone->device_model }}</td>
                        <td>{{ $phone->device_brand }}</td>
                        <td>{{ $phone->imei }}</td>
                        <td>{{ $phone->buying_price }}</td>
                        <td>{{ $phone->sell_price }}</td>
                        <td>
                            {{-- <button class="btn btn-primary  print-label-btn" onclick="printLabel('{{ $phone->device_model }}', '${{ $phone->sell_price }}')">Print Label</button> --}}
                            <button class="btn btn-info btn-sm sell-phone-btn"
                                onclick="populatePhoneDetails({{ json_encode($phone) }})">View Details</button>
                        </td>

                        {{-- <td>{{isset($customer->address) && $customer->address->street_address ? $customer->address->street_address : 'No address available'  }} --}}
                        <!-- Add more table data here as needed -->
                    </tr>
                @endforeach

            </table>
            <div class="d-flex justify-content-end mt-4 mr-4">
                {{ $phones->links('pagination::bootstrap-4') }}
            </div>
    </div>
@else
    <p>No Phone found.</p>
    @endif


@endsection

@push('js')
    <script>
        // function printLabel(phoneName, phonePrice) {
        //     var printWindow = window.open('', '_blank');
        //     printWindow.document.write('<html><head><title>Phone Label</title></head><body>');

        //     // Print label for the specific phone
        //     printWindow.document.write('<div style="margin-bottom: 20px;">');
        //     printWindow.document.write('<p>' + phoneName + '</p>');
        //     printWindow.document.write('<p>Price: ' + phonePrice + '</p>');
        //     printWindow.document.write('</div>');

        //     printWindow.document.write('</body></html>');
        //     printWindow.document.close();
        //     printWindow.print();
        // }

        $("#discountInput").on("input", function() {
            updateTotalPrice();
        });

        function updateTotalPrice() {
            // Get selling price and discount values
            var sellingPrice = parseFloat($("#sellingPrice").val()) || 0;
            var discount = parseFloat($("#discountInput").val()) || 0;

            var discountPercentage = Math.min(Math.max(discount, 0), 100);
            $("#discountInput").val(discountPercentage);

            if (discountPercentage > 100) {
                // Display error message and clear total price
                $("#discountError").text("Discount should be less than or equal to 100");
                $("#totalPriceText").text("");
                $("#totalPrice").val("");
            } else {
                // Calculate total price
                var totalPrice = sellingPrice - (sellingPrice * discountPercentage) / 100;

                // Display total price
                $("#totalPriceText").text(totalPrice.toFixed(2));

                // Update hidden input value
                $("#totalPrice").val(totalPrice.toFixed(2));
            }

        }

        function populatePhoneDetails(phone) {
            // Populate the <p> tags
            document.getElementById('deviceModelText').innerText = phone.device_model;
            document.getElementById('deviceBrandText').innerText = phone.device_brand;
            document.getElementById('deviceImeiText').innerText = phone.imei;
            document.getElementById('sellingPriceText').innerText = phone.sell_price;
            document.getElementById('totalPriceText').innerText = phone.sell_price;


            // Populate the hidden input fields
            document.getElementById('deviceModel').value = phone.device_model;
            document.getElementById('deviceBrand').value = phone.device_brand;
            document.getElementById('imei').value = phone.imei;
            document.getElementById('sellingPrice').value = phone.sell_price;
            document.getElementById('totalPrice').value = phone.sell_price;

            
            document.getElementById('phoneId').value = phone.id;


            // Display the card
            document.getElementById('phoneDetailCard').style.display = 'block';
            // Scroll to the card
            document.getElementById('phoneDetailCard').scrollIntoView({
                behavior: 'smooth',
                block: 'start',
            });
        }
    </script>
@endpush
