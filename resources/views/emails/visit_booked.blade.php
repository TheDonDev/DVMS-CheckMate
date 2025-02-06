<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visit Booking Confirmation</title>
</head>
<body>
    <h1>Visit Booking Confirmation</h1>
    <p>Dear {{ $visitorDetails->first_name }} {{ $visitorDetails->last_name }},</p>
    <p>Your visit has been successfully booked!</p>
    <p>Visit Number: {{ $visitNumber }}</p>
    <p>Host: {{ $host->name }}</p>
    <p>Host Email: {{ $host->email }}</p>
    <p>Host Number: {{ $host->number }}</p>
    <p>Thank you for using CheckMate!</p>
</body>
</html>
