<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Joined Notification</title>
</head>
<body>
    <h1>CheckMate</h1>
    <p>{{ $data['first_name'] }} {{ $data['last_name'] }} has joined your visit.</p>
    <p>Details:</p>
    <ul>
        <li>Designation: {{ $data['designation'] }}</li>
        <li>Email: {{ $data['email'] }}</li>
        <li>Phone: {{ $data['phone'] }}</li>
        <li>Organization: {{ $data['organization'] }}</li>
    </ul>
    <p>Visitor Number: {{ $visitorNumber }}</p> <!-- Include visitor number -->
    <p>Thank you!</p>
</body>
</html>
