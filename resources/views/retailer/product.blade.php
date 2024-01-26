@extends('layouts.retailer')

@section('content')
@include('retailer.partials.response_message')
<div class=" mb-3">
    <div class="row">
        <h3 class="mb-5 col-md-12">Product</h3>
        <div class="col-md-8 mb-4">
            <form action="" method="GET" class="row">
                <div class="form-group col-md-3">
                    <select class="form-control" id="exampleFormControlSelect1">
                    <option disabled selected>All Products</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    </select>
                </div>
                <div class=" col-md-3 px-0">
                    <div class="input-group">
                        <button class="btn btn-primary w-100 text-white">Filter by Cateogry</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" name="search" class="border-primary form-control" placeholder="Search">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            <table class="table customer-table">
                <thead>
                    <tr class="text-muted">
                        <th class=" font-weight-normal"></th>
                        <th class=" font-weight-normal">Name</th>
                        <th class=" font-weight-normal">Price</th>
                        <th class=" font-weight-normal">Stock</th>
                    </tr>
                </thead>
                <tbody>
                        <tr class="text-dark font-weight-bold">
                            <td class="text-muted">1ys971</td>
                            <td>Kashmala Ali</td>
                            <td>$70.00</td>
                            <td>20</td>
                        </tr>
                </tbody>
            </table>
            <div class="row px-3">
                    <div class="col-md-9"> Page 1 of 1</div>
                    <div class="col-md-3 text-right">
                        <a href="" class=" btn-primary btn">New Product</a>
                    </div>
                </div>
            <div class="d-flex justify-content-end mt-4 mr-4">
            </div>
        </div>
    </div>
</div>
<!-- <div class="card">
    <div class="card-body">
        <strong>No customers found.</strong>
    </div>
</div> -->
@endsection
