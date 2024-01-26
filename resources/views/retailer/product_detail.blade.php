@extends('layouts.retailer')

@section('content')
@include('retailer.partials.response_message')
<div class=" mb-3">
    <div class="row">
        <h3 class="mb-2 col-md-8">Product</h3>
        <div class="col-md-4 mb-2">
            <form action="" method="GET" class="row">
                <div class="form-group col-md-4 px-1">
                    <select class="form-control bg-primary text-white" id="exampleFormControlSelect1">
                        <option disabled selected>Action</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <div class=" col-md-4 px-1">
                    <div class="input-group">
                        <button class="btn btn-primary w-100 text-white">Edit</button>
                    </div>
                </div> 
                <div class=" col-md-4 px-1">
                    <div class="input-group">
                        <button class="btn btn-dark w-100 text-white" type="button" data-toggle="modal" data-target="#exampleModal">Add Stock</button>
                    </div>
                </div> 
            </form>
        </div>
        <div class="col-md-12">
            <div class="bg-primary text-white py-3 px-4 mb-4"><h5 class="mb-0">Stock Added</h5></div>
        </div>
        <div class="col-md-6">
            <table class="table customer-table ">
                <tbody>
                    <tr>
                        <th class=" font-weight-normal text-muted">PRICE</th>
                        <td class="text-dark font-weight-bold">$8.00</td>
                    </tr>  
                    <tr>
                        <th class=" font-weight-normal text-muted">CATEGORY</th>
                        <td class="text-dark font-weight-bold">Iphone X</td>
                    </tr>  
                </tbody>
            </table>
            <table class="table customer-table my-5">
                <tbody>
                    <tr>
                        <th class=" font-weight-normal text-muted">STOCK</th>
                        <td class="text-dark font-weight-bold">44</td>
                    </tr>
                    <tr>
                        <th class=" font-weight-normal text-muted">MIN STOCK</th>
                        <td class="text-dark font-weight-bold">23</td>
                    </tr> 
                    <tr>
                        <th class=" font-weight-normal text-muted">MAINTAIN STOCK</th>
                        <td class="text-dark font-weight-bold">-</td>
                    </tr>  
                </tbody>
            </table>
            <table class="table customer-table ">
                <tbody>
                    <tr>
                        <th class=" font-weight-normal text-muted">SUPPLIERS</th>
                        <th class=" font-weight-normal text-muted">PRODUCT SKU</th>
                    </tr>
                    <tr class="text-dark font-weight-bold">
                        <th>Nokia</th>
                        <td>76122</td>
                    </tr> 
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table customer-table ">
                <tbody>  
                    <tr>
                        <th class="">Activity Days 30</th>
                    </tr>
                    <tr class="text-dark font-weight-bold">
                        <th>Stock</th>
                        <td>40 stock added from nokia. New total:539</td>
                    </tr>   
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Stock</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
                <label for="">Quantity</label>
                <input type="email" class="form-control" id="" placeholder="">
            </div>
            <div class="form-group">
                <label for="">Suppliers</label>
                <input type="email" class="form-control" id="" placeholder="">
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">Do not print labels</label>
            </div>
            <button class="btn btn-dark w-100 py-2 text-white">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
