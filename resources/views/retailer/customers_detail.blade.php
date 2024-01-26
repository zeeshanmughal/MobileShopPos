@extends('layouts.retailer')

@section('content')
@include('retailer.partials.response_message')
<div class="row">
    <h1 class="col-md-12 mb-4">AHSAN <span class="text-primary"> MUGHAL</span></h1>
    <div class="col-md-6 mb-4">
        <table class="table customer-table ">
            <tbody>  
                    <tr>
                        <th class=" font-weight-normal text-muted">Type</th>
                        <td class="text-dark font-weight-bold">Individual</td>
                    </tr> 
                    <tr>
                        <th class=" font-weight-normal text-muted">Name</th>
                        <td class="text-dark font-weight-bold">Kashmala Ali</td>
                    </tr> 
                    <tr>
                        <th class=" font-weight-normal text-muted">Mobile no.</th>
                        <td class="text-dark font-weight-bold">0330-6738338</td>
                    </tr> 
                    <tr>
                        <th class=" font-weight-normal text-muted">Alternate no.</th>
                        <td class="text-dark font-weight-bold">0300-1122568</td>
                    </tr>  
                    <tr>
                        <th class=" font-weight-normal text-muted">Email</th>
                        <td class="text-dark font-weight-bold">kashmalaali31@gmail.com</td>
                    </tr>  
                    <tr>
                        <th class=" font-weight-normal text-muted">Referred by</th>
                        <td class="text-dark font-weight-bold">-</td>
                    </tr>  
                    <tr>
                        <th class=" font-weight-normal text-muted">Proof of Id</th>
                        <td class="text-dark font-weight-bold">-</td>
                    </tr>  
                    <tr>
                        <th class=" font-weight-normal text-muted">Notes</th>
                        <td class="text-dark font-weight-bold">-</td>
                    </tr>  
            </tbody>
        </table>
    </div>
    <div class="col-md-6"></div>
    <!-- TRANSACTION TAble -->
    <div class="col-md-6">
        <table class="table customer-table ">
            <tbody>  
                    <tr>
                        <th class="">Transactions</th>
                    </tr> 
                    <tr class=" font-weight-normal text-muted font-14">
                        <th> </th>
                        <th>Type</th>
                        <th>Created</th>
                        <th>Item</th>
                        <th>Amount</th>
                        <th>Method</th>
                    </tr> 
                    <tr class="text-dark font-weight-bold font-14">
                        <td class="text-info"> 5sya89</td>
                        <td>Buy & Sell</td>
                        <td>12/12/24 8:00</td>
                        <td></td>
                        <td>$10.00</td>
                        <td>Cash</td>
                    </tr> 
                    <tr>
                        <th class=" font-weight-normal text-muted">Created</th>
                        <td class="text-dark font-weight-bold">12/12/24 8:08</td>
                    </tr>  
                    <tr>
                        <th class=" font-weight-normal text-muted">Last Updated</th>
                        <td class="text-dark font-weight-bold">12/12/24 8:00</td>
                    </tr>  
            </tbody>
        </table>
    </div>
    <!-- TICKETS TABLE -->
    <div class="col-md-6">
    <table class="table customer-table ">
    <tbody>  
                    <tr>
                        <th class="">Tickets</th>
                    </tr> 
                    <tr class=" font-weight-normal text-muted font-14 text-center">
                        <th>Statue</th>
                        <th>Device</th>
                        <th>Created</th>
                    </tr> 
                    <tr class="text-dark font-weight-bold font-14 text-center">
                        <td colspan="3">No ticket found</td>
                    </tr> 
                    <tr>
                        <th class=" font-weight-normal text-muted">Created</th>
                        <td class="text-dark font-weight-bold">12/12/24 8:08</td>
                    </tr>  
                    <tr>
                        <th class=" font-weight-normal text-muted">Last Updated</th>
                        <td class="text-dark font-weight-bold">12/12/24 8:00</td>
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
