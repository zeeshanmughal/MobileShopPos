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
        <p>
            An email has been sent to your address. Please click the verification link in the email to complete the registration process.
        </p>
        <form method="post" action="{{ route('user.verify',['token' => $token]) }}">
            @csrf
            <button type="submit">Resend Email</button>
        </form>
    </div>
</body>
</html>
