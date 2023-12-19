<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        @auth
                            @if (auth()->user()->email_verified_at)
                                <div class="alert alert-success" role="alert">
                                    {{ __('Your email has been verified.') }}
                                </div>
                            @else
                                {{ __('Before proceeding, please check your email for a verification link.') }}
                                {{ __('If you did not receive the email') }},
                                <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline"
                                            @if (auth()->user()->status !== 'active') disabled @endif>
                                        {{ __('Click here to request another') }}
                                    </button>.
                                </form>
                            @endif
                        @else
                            {{-- User is not authenticated --}}
                            {{ __('Please log in to continue.') }}
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
