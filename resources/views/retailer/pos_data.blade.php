@extends('layouts.retailer')

@section('content')

    <div class="row wrapper">
        <div class="col-md-6">
            <div class=" d-flex pos-search nav-bar">
                <div class="searchbox-wrapper ">
                    <div class="search-box ">
                        <input type="text" name="" placeholder="SKU or listing no." id="">
                        <span class="fa fa-search search-icon"></span>
                        <input type="text" placeholder="Search Product">
                    </div>
                </div>
            </div>
            <!-- BUTTONS -->
            <div class="pos-btns mt-5 row px-2">
                <div class="col-md-6">
                    <button class="btn btn-primary w-100">Headphones</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary w-100">Handfree</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary w-100">Charger</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary w-100">Case</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary w-100">I Phone X</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary w-100">I Phone 11</button>
                </div>
            </div>
            <div class="covers">
                <h3 class="py-4">COVERS</h3>
                <p>Iphone 12 Case</p>
                <p>$11.00</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="pos-slip">
                <!-- TRANSACTION CREATED -->
                <div class="row px-3 mb-2">
                    <div class="col-md-12">
                        <button class="btn btn-primary w-100 text-left py-2">TRANSACTION CREATED</button>
                    </div>
                </div>
                <!-- ENDS here -->
                <div class="row px-3">
                    <div class="col-md-4">ITEM</div>
                    <div class="col-md-3">PRICE</div>
                    <div class="col-md-2">QTY</div>
                    <div class="col-md-3">TOTAL</div>
                </div>
                <hr class="my-2">
                <div class="row px-3">
                    <div class="col-md-4">Iphone 12 Case</div>
                    <div class="col-md-3">$10.00</div>
                    <div class="col-md-2">2</div>
                    <div class="col-md-3">$50.00</div>
                    <!-- NO ITEM ADDED -->
                    <div class="col-md-12"><hr class="my-1"></div>
                    <hr class="my-1">
                    <div class="col-md-12 pb-3  text-center">No Item Added</div>
                    <!-- ENDS HERE -->
                    <p class="text-right col-md-12 "> <span class="text-muted">TOTAL</span> <span class="font-weight-bold"> $70.00</span></p>
                
                </div>
                
                <div class="row px-3 cash-input">
                    <div class="col-md-12 d-flex">
                        <span>$</span>
                        <input type="text" class="w-100 ml-1" placeholder="Discounted Total">
                    </div>
                </div>
                <div class="row px-3">
                    <div class="col-md-4"><button class="btn w-100 bg-light text-black">Cash</button></div>
                    <div class="col-md-4"><button class="btn w-100 bg-light text-black">Card</button></div>
                    <div class="col-md-4"><button class="btn w-100 bg-light text-black">Spit</button></div>
                </div>
                <div class="row px-3 cash-input">
                    <div class="col-md-6">
                        <label for="" class="font-weight-bold">Cash</label> <br>
                        <div class="d-flex">
                            <span>$</span>
                            <input type="text" class="w-100 ml-1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="font-weight-bold">Cash</label> <br>
                        <div class="d-flex">
                            <span>$</span>
                            <input type="text" class="w-100 ml-1">
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <button class="btn btn-primary w-100">Submit</button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <!-- -------` -->


@endsection

@push('js')

@endpush
