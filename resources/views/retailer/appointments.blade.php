@extends('layouts.retailer')

@section('content')
@include('retailer.partials.response_message')
<div class="container mb-3">
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-3">
            <form action="{{ route('customers.index') }}" method="GET" class="">
                <div class="input-group">
                    <input type="text" name="search" class="border-primary form-control" placeholder="Appointment Invite URL">
                </div>
            </form>
        </div>
        <div class="col-md-3">
            <a href="{{ route('customer.create')}}" class="w-100 btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Add Customer">
                New Appointments
            </a>
        </div>
    </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="bg-primary text-white p-3 my-2">There are no appointments Scheduled</div>
            </div>
            <div class="col-md-12">
                <div class="bg-primary text-white p-3 my-2">Appointment will be Scheduled on Monday</div>
            </div>
            <div class="col-md-12">
                <div class="bg-primary text-white p-3 my-2">Appointment will be Scheduled on Friday</div>
            </div>
        </div>
        
</div>



@endsection
