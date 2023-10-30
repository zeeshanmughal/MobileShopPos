@extends('layouts.retailer')

@section('content')

<div class="">
    <div class="form-wrap">	
        <form id="survey-form">
            <div class="row">
                <div class="col-md-7">                            
                    <h4 class="text-gray-900 font-weight-bold">Add New Item</h4> <hr>
                </div>
                <div class="col-md-5 text-right">                    
                    <button type="submit" class="btn bg-gradient-primary text-white py-1">Save Item</button>
                    <button type="submit" id="" class="btn bg-gray-300 text-dark py-1">Save and Add New</button>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label id="name-label" for="name">Item Name <sup class="text-danger">*</sup></label>
                        <input type="text" name="name" id="name" placeholder="Enter your name" class="form-control" >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label id="name-label" for="name">Short Description</label>
                        <input type="text" name="name" id="name" placeholder="Enter your name" class="form-control" >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> Item Category </label>
                        <select id="dropdown" name="role" class="form-control">
                            <option disabled selected value>Select</option>
                            <option value="Individual">Student</option>
                            <option value="preferNo">Prefer not to say</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group Picture_2">
                         <label for="">Picture (2MB)</label>
                            <div class="d-flex">
                              <img id="" src="http://placehold.it/180" class="blah mr-1" alt="your image" />
                              <input type='file' class="form-control " onchange="readURL(this);" />
                         </div>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">SubCategory</label>
                        <select id="dropdown" name="role" class="form-control" >
                            <option disabled selected value>Select</option>
                            <option value="Individual">Student</option>
                            <option value="preferNo">Prefer not to say</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Manufacturer</label>
                        <select id="dropdown" name="role" class="form-control" >
                            <option disabled selected value>Select Option</option>
                            <option value="student">Student</option>
                            <option value="job">Full Time Job</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Device Model</label>
                        <input type="text" name="" class="form-control" >
                    </div>
                </div>
                <div class="col-md-12 my-4">
                    <strong class="text-danger">+ Add More Info</strong>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Warranty</label>
                        <input type="text" name="" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">IMEI</label>
                        <input type="text" name="" placeholder="Invalid IMEI Code" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Condition</label>
                        <select id="dropdown" name="role" class="form-control" >
                            <option disabled selected value>Select</option>
                            <option value="Individual">Student</option>
                            <option value="preferNo">Prefer not to say</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Physical Location</label>
                        <select id="dropdown" name="role" class="form-control" >
                            <option disabled selected value>Select</option>
                            <option value="Individual">Student</option>
                            <option value="preferNo">Prefer not to say</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">SKU</label>
                        <input type="text" name="" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">UPC Code</label>
                        <input type="text" name="" class="form-control">
                    </div>
                </div>
            </div>
        </form>
    </div>	
</div>

@endsection