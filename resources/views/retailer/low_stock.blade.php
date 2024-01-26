@extends('layouts.retailer')

@section('content')
@include('retailer.partials.response_message')
<div class=" mb-3">
    <div class="row">
        <h3 class="mb-4 col-md-12">LOW STOCK</h3>
        
        <div class="col-md-12">
            <table class="table customer-table">
                <thead>
                    <tr class="text-muted">
                        <th class=" font-weight-normal">PRODUCT</th>
                        <th class=" font-weight-normal">CURRENT STOCK</th>
                        <th class=" font-weight-normal">MINIMUM</th>
                    </tr>
                </thead>
                <tbody>
                        <tr class="text-dark font-weight-bold">
                            <td>Nokia Handfree</td>
                            <td>10</td>
                            <td>2</td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
