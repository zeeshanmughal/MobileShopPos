<!-- resources/views/manufacturers.blade.php -->

@extends('layouts.retailer') {{-- Assuming you have a layout file --}}

@section('content')
    

    {{-- Display manufacturers --}}
    <div class="d-flex justify-content-end m-4">
    <a href="{{ route('manufacturers.create') }}" class="btn btn-primary ">Add New Manufacturer</a>
    </div>
    @if(Route::currentRouteName() == 'manufacturers.index')
    <div class="card">
        <div class="card-body">
            <div class="card-title"><h4>Manufacturers</h4></div>

            <ul class="list-group list-group-flush">
            @foreach($manufacturers as $manufacturer)
                <li class="list-group-item d-flex justify-content-between align-items-center"> <span> {{ $manufacturer->name }}</span>  <span><a href="{{ route('manufacturers.edit', $manufacturer->id) }}" class="btn btn-info btn-sm">Edit</a>
                    <form action="{{ route('manufacturers.destroy', $manufacturer->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure you want to delete this manufacturer?')">Delete</button>
                    </form>
                    </span>
                </li>
           
            @endforeach
        </ul>
    </div>
    </div>

    {{-- Create or Edit form --}}
    @elseif(Route::currentRouteName() == 'manufacturers.create' || Route::currentRouteName() == 'manufacturers.edit')
        <form method="POST" action="{{ isset($manufacturer) ? route('manufacturers.update', $manufacturer->id) : route('manufacturers.store') }}">
            @csrf
            @if(isset($manufacturer))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="name">Manufacturer Name:</label>
                <input type="text" name="name" value="{{ isset($manufacturer) ? $manufacturer->name : '' }}"  class="form-control" required>
    
            </div>
          
            <button type="submit" class="btn btn-primary">{{ isset($manufacturer) ? 'Update' : 'Create' }}</button>
        </form>

    {{-- Show confirmation message --}}
    @elseif(Route::currentRouteName() == 'manufacturers.destroy')
        <p>manufacturer deleted successfully. <a href="{{ route('manufacturers.index') }}">Back to manufacturers</a></p>
    @endif
@endsection
