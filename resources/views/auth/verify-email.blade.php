<!-- resources/views/auth/verify-email.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <div style="text-align: center; padding: 20px;">
        <h2>Email Verification</h2>
        <p>
            Your email address has been successfully verified. You can now log in to your account.
        </p>
        <p>
            <a href="{{ url('/login') }}">Login</a>
        </p>
    </div>
</body>
</html>
