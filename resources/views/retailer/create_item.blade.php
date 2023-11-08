@extends('layouts.retailer')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="">
    <div class="form-wrap">	
        <form id="itemForm" method="POST" action="{{ isset($item) ? route('item.update', $item->id) : route('item.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($item))
                @method('PUT')
            @endif
            <div class="row">
                <div class="col-md-7">                            
                    <h4 class="text-gray-900 font-weight-bold">Add New Item</h4> <hr>
                </div>
                <input type="hidden" name="save_and_add_new" value="0">
                <div class="col-md-5 text-right">                    
                    <button type="submit" class="btn bg-gradient-primary text-white py-1" >{{ isset($item)? 'Update Item': 'Save Item'  }}</button>
                    @if(!isset($item))
                    <button type="submit" value="1"  name="save_and_add_new" id="saveAndAddNewButton" class="btn bg-gray-300 text-dark py-1">Save and Add New</button>
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sku">SKU</label>
                        <input type="text" name="sku" id="sku" value="{{isset($item) ? $item->sku : old('sku') }}" placeholder="Enter Sku" class="form-control">
                        @if ($errors->has('sku'))
                        <span class="text-danger">{{ $errors->first('sku') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label id="name-label" for="itemName">Item Name <sup class="text-danger">*</sup></label>
                        <input type="text" name="item_name" id="itemName" value="{{ isset($item) ? $item->item_name : old('item_name') }}" placeholder="Enter your name" class="form-control" >
                        @if ($errors->has('item_name'))
                        <span class="text-danger">{{ $errors->first('item_name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label id="name-label" for="shortDescription">Short Description</label>
                        <input type="text" name="short_description" id="shortDescription" value="{{isset($item) ?  $item->short_description : old('short_description') }}" placeholder="Enter short description" class="form-control" >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> Item Category </label>
                        <select id="dropdown" name="item_category" id="itemCategory" class="form-control">
                            <option disabled selected value>Select</option>
                            <option value="Individual" {{ (isset($item) && $item->item_category === 'category1') ? 'selected' : (old('item_category') === 'category1' ? 'selected' : '') }}>Student</option>
                            <option value="preferNo" {{ (isset($item) && $item->item_category === 'category1') ? 'selected' : (old('item_category') === 'category1' ? 'selected' : '') }}>Prefer not to say</option>
                            <option value="other" {{ (isset($item) && $item->item_category === 'category1') ? 'selected' : (old('item_category') === 'category1' ? 'selected' : '') }}>Other</option>
                        </select>
                        @if ($errors->has('item_category'))
                        <span class="text-danger">{{ $errors->first('item_category') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group Picture_2">
                         <label for="">Picture (2MB)</label>
                            <div class="d-flex">
                              <img id="" src="http://placehold.it/180" class="blah mr-1" alt="your image" />
                              <input type='file'  name="image" class="form-control " onchange="readURL(this);" />
                         </div>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="subCategory">Sub Category</label>
                        <select id="dropdown" name="sub_category" id="subCategory" class="form-control" >
                            <option disabled selected value>Select</option>
                            <option value="Individual" {{ (isset($item) && $item->sub_category === 'category1') ? 'selected' : (old('sub_category') === 'category1' ? 'selected' : '') }} >Student</option>
                            <option value="preferNo" {{ (isset($item) && $item->sub_category === 'category1') ? 'selected' : (old('sub_category') === 'category1' ? 'selected' : '') }}>Prefer not to say</option>
                            <option value="other" {{ (isset($item) && $item->sub_category === 'category1') ? 'selected' : (old('sub_category') === 'category1' ? 'selected' : '') }}>Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Manufacturer</label>
                        <select id="dropdown" name="manufacturer" id="manufacturer" class="form-control" >
                            <option disabled selected value>Select Option</option>
                            <option value="student" {{ (isset($item) && $item->manufacturer === 'category1') ? 'selected' : (old('manufacturer') === 'category1' ? 'selected' : '') }}>Student</option>
                            <option value="job" {{ (isset($item) && $item->manufacturer === 'category1') ? 'selected' : (old('manufacturer') === 'category1' ? 'selected' : '') }}>Full Time Job</option>
                            <option value="other" {{ (isset($item) && $item->manufacturer === 'category1') ? 'selected' : (old('manufacturer') === 'category1' ? 'selected' : '') }} >Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Device Model</label>
                        <input type="text" name="device_model" id="deviceModel" class="form-control" value="{{isset($item) ?  $item->device_model : old('device_model') }}" >
                    </div>
                </div>
                <div class="col-md-12 my-4">
                    <strong class="text-danger">+ Add More Info</strong>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="warranty">Warranty</label>
                        <input type="text" name="warranty" id="warranty" class="form-control" value="{{isset($item) ?  $item->warranty : old('warranty') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">IMEI</label>
                        <input type="text" name="imei" placeholder="Enter IMEI Code" class="form-control" value="{{isset($item) ?  $item->imei : old('imei') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Condition</label>
                        <select id="dropdown" name="condition" id="condition" class="form-control" >
                            <option disabled selected value>Select</option>
                            <option value="Individual" {{ (isset($item) && $item->condition === 'category1') ? 'selected' : (old('condition') === 'category1' ? 'selected' : '') }}>Student</option>
                            <option value="preferNo" {{ (isset($item) && $item->condition === 'category1') ? 'selected' : (old('condition') === 'category1' ? 'selected' : '') }}>Prefer not to say</option>
                            <option value="other" {{ (isset($item) && $item->condition === 'category1') ? 'selected' : (old('condition') === 'category1' ? 'selected' : '') }}>Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Physical Location</label>
                        <select id="dropdown" name="physical_location" id="physicalLocation" class="form-control" >
                            <option disabled selected value>Select</option>
                            <option value="Individual"  {{ (isset($item) && $item->physical_location === 'category1') ? 'selected' : (old('physical_location') === 'category1' ? 'selected' : '')  }}>Student</option>
                            <option value="preferNo"  {{ (isset($item) && $item->physical_location === 'category1') ? 'selected' : (old('physical_location') === 'category1' ? 'selected' : '')  }}>Prefer not to say</option>
                            <option value="other"  {{ (isset($item) && $item->physical_location === 'category1') ? 'selected' : (old('physical_location') === 'category1' ? 'selected' : '')  }}>Other</option>
                        </select>
                    </div>
                </div>
              
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="upcCode">UPC Code</label>
                        <input type="text" name="upc_code" id="upcCode" class="form-control" value="{{isset($item) ?  $item->upc_code : old('upc_code') }}">
                    </div>
                </div>
            </div>
        </form>
    </div>	
</div>

@endsection