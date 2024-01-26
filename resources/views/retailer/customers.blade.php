@extends('layouts.retailer')

@section('content')
@include('retailer.partials.response_message')
<div class="container mb-3">
    <div class="row">
        <div class="col-md-7"></div>
        <div class="col-md-2">
            <a href="{{ route('customer.create')}}" class="w-100 btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Add Customer">
                New Customer
            </a>
        </div>
        <div class="col-md-3">
            <form action="{{ route('customers.index') }}" method="GET" class="">
                <div class="input-group">
                    <input type="text" name="search" class="border-primary form-control" placeholder="Search">
                    <!-- <div class="input-group-append mr-2">
                        <button type="submit" class="btn btn-outline-info">Search</button>
                    </div> -->
                </div>
            </form>
        </div>
    </div>
</div>


@if(count($customers) > 0)
    <table class="table customer-table ">
        <thead>
            <tr class="text-dark">
                <th class=" font-weight-normal">Name</th>
                <!-- <th>Last Name</th> -->
                <th class=" font-weight-normal">Phone</th>
                <th class=" font-weight-normal">Email</th>
                <th class=" font-weight-normal">Created</th>
                <!-- <th>Edit</th>
                <th>Delete</th> -->
                <!-- Add more table headers here as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                <tr class="text-dark font-weight-bold">
                    <td>{{ $customer->first_name }}</td>
                    <!-- <td>{{ $customer->last_name }}</td> -->
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>12-12-24 12:00</td>
                    <!-- <td>{{ $customer->customer_group }}</td> -->
                    <!-- <td> <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                    <td>
                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                        </form>
                    </td> -->
                    <!-- Add more table data here as needed -->
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row px-3">
            <div class="col-md-9"> Page 1 of 1</div>
            <div class="col-md-3 text-right">
                <button type="button" class=" btn-primary btn">Never</button>
                <button type="button" class="btn border text-grey">Close</button>
            </div>
        </div>
    <div class="d-flex justify-content-end mt-4 mr-4">
        {{ $customers->links('pagination.custom') }}
    </div>

@else
<div class="card">
    <div class="card-body">
        <strong>No customers found.</strong>
    </div>
</div>
@endif

@endsection
