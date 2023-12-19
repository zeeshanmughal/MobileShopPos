@extends('layouts.retailer')

@section('content')

<form action="{{ route('subscribe') }}" method="post">
    @csrf
    <input type="hidden" name="payment_method" value="{{ $intent->client_secret }}">
    <button type="submit">Subscribe</button>
</form>

@endsection