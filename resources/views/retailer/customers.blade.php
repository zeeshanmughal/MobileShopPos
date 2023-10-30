@extends('layouts.retailer')

@section('content')

<div class="">
    <div class="form-wrap">	
        <form id="survey-form">
            <div class="row">
                <div class="col-md-12">                            
                    <h3 class="text-gray-900 fw-bold">Basic information</h1> <hr>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Customer Group</label>
                        <select id="dropdown" name="role" class="form-control" required>
                            <option disabled selected value>Select</option>
                            <option value="Individual">Student</option>
                            <option value="preferNo">Prefer not to say</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label id="name-label" for="name">Organization</label>
                        <input type="text" name="name" id="name" placeholder="Enter your name" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label id="name-label" for="name">First Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter your name" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Last Name</label>
                        <input type="text" name="" placeholder="Enter your name" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label id="email-label" for="email">Email</label>
                        <div class="d-flex">
                            <input type="email" name="email" id="email" placeholder="Email@domain.com" class=" mr-1 form-control" required>
                            <button class="btn bg-gradient-primary text-white py-0 px-3 ">+</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="">Phone</label>
                        <div class="d-flex">
                            <input type="text" id="mobile_code" class="form-control" placeholder="Phone Number" name="name">
                            <button class="btn bg-gradient-primary text-white py-0 px-3  ml-1">+</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>How did you hear about us?</label>
                        <select id="dropdown" name="role" class="form-control" required>
                            <option disabled selected value>Select Option</option>
                            <option value="student">Student</option>
                            <option value="job">Full Time Job</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tax Class</label>
                        <select id="dropdown" name="role" class="form-control" required>
                            <option disabled selected value>Select Option</option>
                            <option value="student">Student</option>
                            <option value="job">Full Time Job</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">                            
                    <h3 class="text-gray-900 fw-bold">Address</h1> <hr>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Customer ID Type </label>
                        <input type="text" name="" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">ID Number</label>
                        <input type="text" name="" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Driving license</label>
                        <input type="text" name="" class="form-control" required>
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

            </div>
            <div class="row">
                <div class="col-md-12">                            
                    <h3 class="text-gray-900">Additional information</h1> <hr>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Street Address </label>
                        <input type="text" name="" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">House / Apartment / Floor Number</label>
                        <input type="text" name="" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">City</label>
                        <input type="text" name="" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">State</label>
                        <input type="text" name="" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">PostCode</label>
                        <input type="text" name="" class="form-control" required>
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
            </div>
            <div class="row">
                <div class="col-md-12">                            
                    <h3 class="text-gray-900">Contact Person Details</h1> <hr>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Contact Person</label>
                        <input type="text" name="" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" name="" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Relation</label>
                        <input type="text" name="" class="form-control" required>
                    </div>
                </div>

            </div>
            
            <div class="row">
                <div class="col-md-12">                            
                    <h3 class="text-gray-900">Custom Fields</h1> <hr>
                </div>
                <div class="col-md-12">
                    <div class="custom_field_box">
                        <p>You haven't created custom field yet.</p>
                        <button class="btn bg-gradient-primary text-white p-2"> Add Custom Field</button>
                    </div>
                </div>

            </div>
            <div class="row">
                <!-- <div class="col-md-6">
                    <div class="form-group">
                        <label>Would you recommend survey to a friend?</label>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline1" value="Definitely" name="customRadioInline1" class="custom-control-input" checked="">
                            <label class="custom-control-label" for="customRadioInline1">Definitely</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline2" value="Maybe" name="customRadioInline1" class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline2">Maybe</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline3" value="Not sure" name="customRadioInline1" class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline3">Not sure</label>
                        </div>
                    </div>
                </div> -->
                <div class="col-md-12">                            
                    <h3 class="text-gray-900">Alert Settings</h1> <hr>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" name="yes" value="yes" id="yes" checked="">
                            <label class="custom-control-label" for="yes">Compliance with GDPR</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" name="yes" value="yes" id="yes" checked="">
                            <label class="custom-control-label" for="yes">SMS Notifications</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" name="yes" value="yes" id="yes" checked="">
                            <label class="custom-control-label" for="yes">Email Notifiactions</label>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row d-none">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Leave Message</label>
                        <textarea  id="comments" class="form-control" name="comment" placeholder="Enter your comment here..."></textarea>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn bg-gradient-primary text-white ">Save Customers</button>
                    <button type="submit" id="" class="btn bg-gray-800 text-white ">Save & add another Customer</button>
                    <button type="submit" id="" class="btn bg-gray-300 text-dark ">Cancel</button>
                </div>
            </div>

        </form>
    </div>	
</div>

@endsection