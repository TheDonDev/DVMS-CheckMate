<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Joined Notification</title>
</head>
<body>
    <h1>CheckMate</h1>
    {{-- <p>Dear {{ $firstName }} {{ $lastName }},</p> --}}
    <p>{{ $data['first_name'] }} {{ $data['last_name'] }} has joined your visit.</p>
    <p>Details:</p>
    <ul>
        <li>Designation: {{ $designation }}</li>
        <li>Email: {{ $email }}</li>
        <li>Phone: {{ $phone }}</li>
        <li>Organization: {{ $organization }}</li>
    </ul>
    <p>Thank you!</p>
</body>
</html>