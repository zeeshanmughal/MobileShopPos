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

<h1>Phones</h1>
@if(count($phones) > 0)
    <table class="table">
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
        @foreach($phones as $p => $phone)
            <tr>
                <td>{{ $phone->device_model }}</td>
                <td>{{ $phone->device_brand }}</td>
                <td>{{ $phone->imei }}</td>
                <td>{{ $phone->buying_price }}</td>
                <td>{{ $phone->sell_price }}</td>

                {{-- <td>{{isset($customer->address) && $customer->address->street_address ? $customer->address->street_address : 'No address available'  }} --}}
                <!-- Add more table data here as needed -->
            </tr>
        @endforeach
    </table>
@else
    <p>No customers found.</p>
@endif


@endsection