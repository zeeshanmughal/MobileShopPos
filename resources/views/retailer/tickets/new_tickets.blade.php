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
                    <div class="form-group select-bubble">
                        <div class="row">
                            <div class="col-md-8">
                                <label for="inputAddress">Issue</label>
                            </div>
                            <div class="col-md-4 text-right"> <small>Show: Most Used/All</small> </div>
                        </div>
                        <button>Charge issue</button>
                        <button>No battery</button>
                        <button>Mic issue</button>
                        <button>Display damage</button>
                        <button>No power</button>
                        <button>Unlocking</button>
                        <button>Hardware-other</button>
                        <button>Software</button>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Tested By!</label>
                        <input type="text" class="form-control" id="" placeholder="No One">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="inputEmail4">Warranty Offered</label>
                        <input type="text" class="form-control" id="" placeholder="None">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="inputPassword4">Estimated Time</label>
                        <input type="text" class="form-control" id="" placeholder="Hour">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="inputEmail4">Pick-Up Time</label>
                        <input type="text" class="form-control" id="" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="inputPassword4">Add Pin</label>
                        <input type="text" class="form-control" id="" placeholder="">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputAddress">Details</label>
                        <textarea type="text" class="form-control" id="" placeholder=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Price</label>
                        <input type="text" class="form-control" id="" placeholder="$">
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
                            <div class="form-group py-3">
                                <input type="text" class="form-control" id="" placeholder="Search by name, email and phone number">
                            </div>
                            <button class="btn btn-primary rounded-pill w-100">Create Ticket</button>
                        </form>
                    </div>
                    <!-- new ticket -->
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <!-- radiobutton tabs -->
                            <div class="form-check form-check-inline">
                                    <input class="form-check-input" checked type="radio" onclick="show2();" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                    <label class="form-check-label" for="inlineRadio1">Individual</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" onclick="show3();" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                <label class="form-check-label" for="inlineRadio2">Business</label>
                            </div>
                        <!-- radio button tabs ends here -->
                            <!-- INDIVIDUAL form -->
                            <form  id="div1">
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
                                <div class="form-group">
                                    <label for="inputAddress">Mail</label>
                                    <input type="text" class="form-control" id="" placeholder="">
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
                                <button class="btn btn-primary mt-3 rounded-pill w-100">Create Ticket</button>
                            </form>
                            <!-- BUSINESS FORM -->
                            <form id="div2" class="hide">
                                <div class="form-group">
                                    <label for="">Company Name</label>
                                    <input type="text" class="form-control" id="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Mail</label>
                                    <input type="text" class="form-control" id="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Mobile No.</label>
                                    <input type="text" class="form-control" id="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Proof of ID</label>
                                    <input type="text" class="form-control" id="" placeholder="">
                                </div>
                                <button class="btn btn-primary mt-3 rounded-pill w-100">Create Ticket</button>
                            </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
    <!-- -------` -->


@endsection

@push('js')
<script> 
function show2(){
  document.getElementById('div1').style.display = 'block';
  document.getElementById('div2').style.display ='none'; 
}

function show3(){
  document.getElementById('div1').style.display ='none';
  document.getElementById('div2').style.display = 'block'; 
} 
</script>
@endpush
