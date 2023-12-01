<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        p {
            margin-bottom: 10px;
        }
        hr {
            border: 1px solid #ccc;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h1>Ticket Information</h1>
    @if (isset($ticketData) && count($ticketData) > 0)
        @foreach ($ticketData as $data)
            <div>
                <p><strong>Ticket ID:</strong> {{ $data['ticket_id'] }}</p>
                <p><strong>Name:</strong> {{ $data['first_name'] }} {{ $data['last_name'] }}</p>
                <p><strong>Email:</strong> {{ $data['email'] }}</p>
                <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
                <p><strong>Device:</strong> {{ $data['device'] }}</p>
                <p><strong>Device Issue:</strong> {{ $data['device_issue'] }}</p>
                <p><strong>Status:</strong> {{ $data['status'] }}</p>
                <hr>
            </div>
        @endforeach
    @else
        <p>No ticket data available.</p>
    @endif
</body>
<script>
    if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>
</html>
