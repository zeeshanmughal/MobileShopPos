@extends('layouts.retailer')

@section('content')
@include('retailer.partials.response_message')
<div class=" mb-3">
    <div class="row">
        <h3 class="mb-4 col-md-12">Notifications</h3>
        
        <div class="col-md-12">
            <table class="table customer-table">
                <tbody>
                        <tr class="text-dark font-weight-bold">
                            <td>20-12-24 12:00</td>
                            <td class="text-muted">‘Nokia Handfree’ is in low Stock</td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection