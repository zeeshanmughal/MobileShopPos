@extends('layouts.retailer')


@section('content')
<h3>Customers</h3>
@if(count($customers) > 0)
    <table class="table">
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
    <p>No customers found.</p>
@endif


@endsection