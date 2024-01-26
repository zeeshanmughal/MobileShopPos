@extends('layouts.retailer')

@section('content')
@include('retailer.partials.response_message')
<div class=" w-50 mb-3">
    <h3 class="product mb-4">Edit Product</h3>
         <form>
             <div class="newticket">
                <div class="form-group">
                    <label for="">Name <sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" id="" placeholder="Enter your device name">
                </div> 
                <div class="form-group">
                    <label for="">Category <sup class="text-danger">*</sup></label>
                        <select class="form-control" id="">
                            <option disabled selected>-</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                </div>
                <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label mb-0" for="customCheck1">Product for selling </label> <br>
                    <small class="text-muted">This will make the product available ib POS system</small>
                </div>
                <div class="form-group">
                    <label for="">Current Stock Count <sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" id="" placeholder="Enter your device name">
                </div>                  
                <div class="form-group">
                    <label for="">Minimun Stock</label>
                    <input type="text" class="form-control" id="" placeholder="Enter your device name">
                </div> 
                <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label mb-0" for="customCheck1">Minimum Stock Alerts</label> <br>
                    <small class="text-muted">This will turn on notifications when stock fall below the minimum stock level.</small>
                </div>
                <div class="form-group">
                    <label for="">Supplier</label>
                    <input type="text" class="form-control" id="" placeholder="Enter your device name">
                </div>
            </div>
            <div class="my-3">
                <button class="btn px-5 py-2 btn-primary text-white">Save</button>
                  </div>
        </form>
</div>
@endsection
