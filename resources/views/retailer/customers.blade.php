@extends('layouts.retailer')

@section('content')
@include('retailer.partials.response_message')
<div class="container mb-3">
    <div class="row">
        <div class="col-md-6">
            <h4>Customers</h4>
        </div>
        <div class="col-md-6 text-md-right">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form action="{{ route('customers.index') }}" method="GET" class="">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search">
                            <div class="input-group-append mr-2">
                                <button type="submit" class="btn btn-outline-info">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2 text-right">
                    <a href="{{ route('customer.create')}}" class="btn btn-info ml-2" data-toggle="tooltip" data-placement="bottom" title="Add Customer">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


@if(count($customers) > 0)
    <table class="table ">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Customer Group</th>
                <th>Edit</th>
                <th>Delete</th>
                <!-- Add more table headers here as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->first_name }}</td>
                    <td>{{ $customer->last_name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->customer_group }}</td>
                    <td> <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                    <td>
                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                        </form>
                    </td>
                    <!-- Add more table data here as needed -->
                </tr>
            @endforeach
        </tbody>
    </table>
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
