@extends('layouts.retailer')

@section('content')
@include('retailer.partials.response_message')
<div class="row">
    <h4 class="col-md-12 mb-4">New Supplier</h4>
    <div class="col-md-6 mb-4">
        <form>
            <div class="newticket">
                    <div class="form-group">
                        <label for="">Company Name</label>
                        <input type="text" class="form-control rounded-0" id="" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for=""> Address</label>
                        <input type="text" class="form-control rounded-0" id="" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control rounded-0" id="" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">Phone Number</label>
                        <input type="text" class="form-control rounded-0" id="" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Website</label>
                        <input type="text" class="form-control rounded-0" id="" placeholder="">
                    </div>
                </div>
                <button class="btn btn-primary rounded-0 m-3">Submit</button>
            </form>
        </div>
    </div>
</div>
<div class="card d-none">
    <div class="card-body">
        <strong>No customers found.</strong>
    </div>
</div> 

@endsection
