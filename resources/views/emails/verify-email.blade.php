<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <!-- Add your Bootstrap CDN or include Bootstrap from your project -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <div class="container mt-5">
        <h4>Yeh Page h Verify Email</h4>
        <h2>Verify Your Email Address</h2>
        <p>Please click the button below to verify your email address:</p>
        <a class="btn btn-primary" href="{{ $verificationUrl }}">Verify Email</a>
        <p>If you did not create an account, no further action is required.</p>
        <p>Thanks,<br>{{ config('app.name') }}</p>
    </div>

</body>
</html>