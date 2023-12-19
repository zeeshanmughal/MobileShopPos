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
                            <option disabled selected value>Select Category</option>
                            @if(sizeof($categories) > 0)
                            @foreach($categories as $c => $cat)
                            <option value="{{ $cat->name }}" {{ (isset($item) && $item->item_category === $cat->name) ? 'selected' : (old('item_category') === $cat->name ? 'selected' : '') }}>{{ $cat->name }}</option>

                            @endforeach
                            @else
                            <option disabled >No category</option>

                            @endif
                        </select> 
                        @if ($errors->has('item_category'))
                        <span class="text-danger">{{ $errors->first('item_category') }}</span>
                        @endif
                    </div>
                </div>
         
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="subCategory">Sub Category</label>
                       <input type="text" class="form-control" name="sub_category" id="subCategory" value="{{isset($item) ?  $item->sub_category : old('sub_category') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Manufacturer</label>
                        <input type="text" name="manufacturer" id="manufacturer" class="form-control" value="{{isset($item) ?  $item->manufacturer : old('manufacturer') }}">
                     
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group Picture_2">
                         <label for="">Picture (2MB)</label>
                            <div class="d-flex">
                                @if(isset($item) && $item->image)
                                <img id="previewItemImage" src="{{ asset($item->image) }}" class="blah mr-1" alt="your image" />
                                @else
                              <img id="previewItemImage" src="http://placehold.it/180" class="blah mr-1" alt="your image" />
                              @endif
                              <input type='file'  name="image" class="form-control" onchange="readURL(this,'previewItemImage');" />
                         </div>
                     </div>
                </div>
               
            
            </div>
        </form>
    </div>	
</div>

@endsection