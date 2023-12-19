<!-- resources/views/categories.blade.php -->

@extends('layouts.retailer') {{-- Assuming you have a layout file --}}

@section('content')
    

    {{-- Display categories --}}
    <div class="d-flex justify-content-end m-4">
    <a href="{{ route('categories.create') }}" class="btn btn-primary ">Add New Category</a>
    </div>
    @if(Route::currentRouteName() == 'categories.index')
    <div class="card">
        <div class="card-body">
            <div class="card-title"><h3>Categories</h3></div>

            <ul class="list-group list-group-flush">
            @foreach($categories as $category)
                <li class="list-group-item d-flex justify-content-between align-items-center"> <span> {{ $category->name }}</span> - <span><a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info btn-sm">Edit</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                    </form>
                    </span>
                </li>
           
            @endforeach
        </ul>
    </div>
    </div>

    {{-- Create or Edit form --}}
    @elseif(Route::currentRouteName() == 'categories.create' || Route::currentRouteName() == 'categories.edit')
        <form method="POST" action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}">
            @csrf
            @if(isset($category))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="name">Category Name:</label>
                <input type="text" name="name" value="{{ isset($category) ? $category->name : '' }}"  class="form-control" required>
    
            </div>
          
            <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Update' : 'Create' }}</button>
        </form>

    {{-- Show confirmation message --}}
    @elseif(Route::currentRouteName() == 'categories.destroy')
        <p>Category deleted successfully. <a href="{{ route('categories.index') }}">Back to Categories</a></p>
    @endif
@endsection
