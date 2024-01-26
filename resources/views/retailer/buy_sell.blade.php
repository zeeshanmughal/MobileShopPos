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
        </div>
        <div class="col-md-6">
            <div class="newticket">
                <h5 class="position-relative cutomerInformation">Customer Information</h5>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Existing Customer</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">New Customer</button>
                </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" id="" placeholder="Search by name, email and phone number">
                            </div>
                            <div class="form-group upload-remove-styling pt-3">
                                <input type="file" id="" placeholder="Search by name, email and phone number">
                            </div>
                            <div class="text-muted pb-4">
                                <p class="mb-1"> One of the following:</p>
                                <ul class="mb-2">
                                    <li>Current Signed Passport</li>
                                    <li>EU National Identity Card</li>
                                    <li>Current UK photocard Driving Licence (full/provisional)</li>
                                </ul>
                                <p class="">Accepted File Formats: JPEG, PNG, PDF</p>
                                <span class="bg-white py-1">  &nbsp; Use Webcam To Take A spanhoto &nbsp;</p>
                            </div>
                            <button class="btn btn-primary rounded-pill w-100">Submit</button>
                        </form>
                    </div>
                    <!-- new ticket -->
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <form >
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Title <sup class="text-danger">*</sup></label>
                                        <input type="text" class="form-control" id="" placeholder="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">First Name</label>
                                        <input type="text" class="form-control" id="" placeholder="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Last Name</label>
                                        <input type="text" class="form-control" id="" placeholder="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <label for="inputEmail4">Phone Number</label>
                                    <input type="text" class="form-control" id="" placeholder="">
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label for="inputPassword4">Alternate Number</label>
                                    <input type="text" class="form-control" id="" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Email Address</label>
                                    <input type="text" class="form-control" id="" placeholder="">
                                </div>
                                <div class="form-group upload-remove-styling  pt-3">
                                    <input type="file" id="" placeholder="Search by name, email and phone number">
                                </div>
                                <div class="text-muted pb-4">
                                    <p class="mb-1"> One of the following:</p>
                                    <ul class="mb-2">
                                        <li>Current Signed Passport</li>
                                        <li>EU National Identity Card</li>
                                        <li>Current UK photocard Driving Licence (full/provisional)</li>
                                    </ul>
                                    <p class="">Accepted File Formats: JPEG, PNG, PDF</p>
                                    <span class="bg-white py-1">  &nbsp; Use Webcam To Take A spanhoto &nbsp;</p>
                                </div>
                                <button class="btn btn-primary mt-3 rounded-pill w-100">Submit</button>
                            </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- -------` -->
@endsection
@push('js')
@endpush
