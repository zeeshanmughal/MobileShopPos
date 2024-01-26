@extends('layouts.retailer')

@section('content')
@include('retailer.partials.response_message')
<div class="row">
        <div class="input-group mb-3 col-md-3">
            <div class="input-group-prepend">
                <span class="input-group-text text-white bg-primary" id="">from</span>
            </div>
            <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3 col-md-3">
            <div class="input-group-prepend">
                <span class="input-group-text text-white bg-primary" id="">to</span>
            </div>
            <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3 col-md-2"> 
            <button class="btn btn-primary text-white">Search</button>
        </div>
    </div>
<div class="row">
    <div class="col-md-12 mb-4">
        <table class="table customer-table ">
            <tbody>
                    <tr class=" font-weight-normal text-muted">
                        <th></th>
                        <th>Type</th>
                        <th>Item(s)</th>
                        <th>Total</th>
                        <th>Method</th>
                        <th>Created</th>
                    </tr>
                    <tr>
                        <td class="text-dark font-weight-bold">7678hj8</td>
                        <td class="text-dark font-weight-bold">Buy & Sell</td>
                        <td class="text-dark font-weight-bold">Iphone X</td>
                        <td class="text-dark font-weight-bold">$77.00</td>
                        <td class="text-dark font-weight-bold">Cash</td>
                        <td class="text-dark font-weight-bold">12-12-23 12:00</td>
                    </tr> 
            </tbody>
        </table>
    </div>
</div>
<div class="card d-none">
    <div class="card-body">
        <strong>No customers found.</strong>
    </div>
</div> 

@endsection
