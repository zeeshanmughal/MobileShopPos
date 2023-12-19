@extends('layouts.retailer')


@section('content')
@include('retailer.partials.response_message')
    <div class="container">
        {{-- <h1>User Profile</h1> --}}
        <div class="card">
            <div class="card-header">User Profile</div>
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ $user->name }}">
                        @error('name')
                            <p class="error-message">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control"
                            value="{{ $user->email }}">
                        @error('email')
                            <p class="error-message">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" id="phone" name="phone" class="form-control"
                            value="{{ $user->phone }}">
                        @error('phone')
                            <p class="error-message">{{ $message }}</p>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="businessName">Business Name:</label>
                        <input type="text" id="businessName" name="business_name" class="form-control"
                            value="{{ $user->business_name }}">
                        @error('business_name')
                            <p class="error-message">{{ $message }}</p>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="businessWebsite">Business Website:</label>
                        <input type="text" id="businessWebsite" name="business_website" class="form-control"
                            value="{{ $user->business_website }}">
                        @error('business_website')
                            <p class="error-message">{{ $message }}</p>
                        @enderror

                    </div>
                    <!-- Add more fields as needed -->

                    <!-- You can include an "Edit Profile" link/button if necessary -->
                    <button type="submit" class="btn btn-primary">Updat Profile</button>
                    {{-- <a href="{{ route('profile.update') }}" class="btn btn-primary">Update Profile</a> --}}
                </form>

            </div>
        </div>

    </div>
@endsection
