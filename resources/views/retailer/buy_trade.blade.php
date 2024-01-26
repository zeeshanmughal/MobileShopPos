@extends('layouts.retailer')

@section('content')

    <div class="row">
        <div class="col-md-6">
             <div class="newticket">
               <h4>Welcome to <span class="text-primary">TechBUFF</span></h4>
                <form>
                    <div class="form-group">
                        <label for="inputAddress">Device Name</label>
                        <input type="text" class="form-control" id="" placeholder="Enter your device name">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="inputEmail4">Serial Number</label>
                        <input type="text" class="form-control" id="" placeholder="Enter your serial number">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="inputPassword4">IMEI</label>
                        <input type="text" class="form-control" id="" placeholder="Enter your IMEI number">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputPassword4">Colours <sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" id="" placeholder="Enter your IMEI number">
                        </div>
                        <div class="form-group  col-md-4">
                            <label for="exampleFormControlSelect1">Network</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            </select>
                        </div>
                        <div class="form-group  col-md-4">
                            <label for="">Internal storage</label>
                            <select class="form-control" id="">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group  col-md-6">
                            <label for="">Condition</label>
                            <select class="form-control" id="">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Battery Health</label>
                            <input type="text" class="form-control" id="" placeholder="Enter your IMEI number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Notes</label>
                        <textarea type="text" class="form-control" id="" placeholder=""></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Purchased Price</label>
                            <input type="text" class="form-control" id="" placeholder="$">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Payment Method <sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" id="" placeholder="">
                        </div>
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox ">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">List for sale immediately</label>
                            </div>
                        </div>
                    </div>
                </form>
             </div>
            <div class=" container-fluid">
                <button class="btn font-weight-bold px-4 mt-3 addbtn-trade bg-white">Add</button>
            </div>
        </div>
        <div class="col-md-6">
            
                <div class=" container-fluid">
                    <h4>Seller</h4>
                    <button class="btn font-weight-bold px-4 mt-3 addbtn-trade bg-white">Add</button>
                </div>
                <div class="total-trade ">
                    <p class="font-25">Totals</p>
                    <div class="newticket p-3 font-weight-bold">
                        <p>
                            Buying: $0.00 <br>
                            Selling: $0.00
                        </p>
                        <p class="">
                            Pay the Customer <br>
                            $0.00
                        </p>
                        <p class="">
                            Method
                        </p>
                        <div class="d-flex mb-3">
                            <button class="btn w-50 bg-white btn-style-trade border-black">Card</button>
                            <button class="btn w-50 bg-white btn-style-trade border-black">Bank Transfer</button>
                        </div>
                        <button class="btn w-100 bg-dark text-white">Complete Transaction</button>
                    </div>
                </div>
        </div>
    </div>
    <!-- -------` -->
@endsection
@push('js')
@endpush
