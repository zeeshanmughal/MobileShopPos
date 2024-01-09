<!-- resources/views/auth/registration-success.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Success</title>
</head>
<body>
    <div style="text-align: center; padding: 20px;">
        <h2>Registration Successful</h2>
        @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif
        <p>
            An email has been sent to your address. Please click the verification link in the email to complete the registration process.
        </p>
        <form method="post" action="{{ route('resendVerificationEmail')}}">
            @csrf
            <input type="hidden" name="user" value={{$user->id}}>
            <button type="submit">Resend Email</button>
        </form>
    </div>
</body>
</html>
