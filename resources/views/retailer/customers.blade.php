@extends('layouts.retailer')


@section('content')

<h1>Customers</h1>
@if(count($customers) > 0)
    <table border="1">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Customer Group</th>

            <!-- Add more table headers here as needed -->
        </tr>
        @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->first_name }}</td>
                <td>{{ $customer->last_name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->customer_group }}</td>

                {{-- <td>{{isset($customer->address) && $customer->address->street_address ? $customer->address->street_address : 'No address available'  }} --}}
                <!-- Add more table data here as needed -->
            </tr>
        @endforeach
    </table>
@else
    <p>No customers found.</p>
@endif

@endsection