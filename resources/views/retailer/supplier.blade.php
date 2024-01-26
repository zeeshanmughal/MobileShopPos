@extends('layouts.retailer')

@section('content')
@include('retailer.partials.response_message')
<div class="row">
    <h3 class="col-md-12 mb-4"> Suppliers</h3>
    <div class="col-md-12 mb-4">
        <table class="table customer-table ">
            <tbody>
                    <tr>
                        <th class="text-muted">Company Name</th>
                    </tr>
                    <tr>
                        <td class="text-dark font-weight-bold">Nike</td>
                    </tr>
                    <tr>
                        <td class="text-dark font-weight-bold">Apple</td>
                    </tr>
                    <tr>
                        <td class="text-dark font-weight-bold">Samsung</td>
                    </tr>
            </tbody>
        </table>
        <button class="btn btn-primary">New Suppliers</button>
    </div>
</div>
<div class="card d-none">
    <div class="card-body">
        <strong>No customers found.</strong>
    </div>
</div> 

@endsection
