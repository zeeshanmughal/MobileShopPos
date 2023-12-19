@extends('layouts.retailer')

@section('content')
<div class="container">
    <h2 class="my-4">Choose a Subscription Plan</h2>

    <div class="row">
        @foreach ($paymentPlans as $plan)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $plan->name.' - $'.$plan->price }} </h3>
                    </div>
                    <div class="card-body">
                        <ul>
                            {{-- <li>Price: ${{ $plan->price }}</li> --}}
                            <li>Duration: {{ $plan->interval }} months</li>
                            @if($plan->features && sizeof($plan->features) > 0)

                                @foreach($plan->features as $f => $row)
                                <li>{{ $row->feature_detail }}</li>
                                @endforeach

                            @endif
                            {{-- {{ dd($plan->features()->feature_detail) }} --}}
                            <!-- Add more details as needed -->
                        </ul>
                    </div>
                    <div class="card-footer">
                        {{-- <form action="{{ route('user.subscribe', ['planId' => $plan->id]) }}" method="post"> --}}
                            {{-- <form >
                            @csrf
                            <button type="submit" class="btn btn-primary">Subscribe</button>
                        </form> --}}
                        <a href="{{ route('user.showSubscribeForm') }}" class="btn btn-primary">Subscribe</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>

@endsection