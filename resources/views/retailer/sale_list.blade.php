@extends('layouts.retailer')

@section('content')
@include('retailer.partials.response_message')
<div class=" mb-3">
    <div class="row">
        <h3 class="mb-4 col-md-12">List of Sales</h3>
        
        <div class="col-md-12">
            <table class="table customer-table">
                <tbody>
                        <tr class="text-muted font-weight-bold">
                            <td class="text-dark">20-12-24 12:00</td>
                            <td>‘Nokia Handfree’ is in low Stock</td>
                            <td>12</td>
                        </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-12 text-right">
            <button class="btn-primary text-white btn py-2">Add  for Sale</button>
        </div>
    </div>
</div>
@endsection