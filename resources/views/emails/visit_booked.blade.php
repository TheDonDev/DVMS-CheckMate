<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visit Booking Confirmation</title>
</head>
<body>
    <h1>Visit Booking Details</h1>
    <p>You have a new visit booking with the following details:</p>
    <ul>
        <li><strong>First Name:</strong> {{ $visitorDetails['first_name'] }}</li>
        <li><strong>Last Name:</strong> {{ $visitorDetails['last_name'] }}</li>
        <li><strong>Designation:</strong> {{ $visitorDetails['designation'] }}</li>
        <li><strong>Organization:</strong> {{ $visitorDetails['organization'] }}</li>
        <li><strong>Email:</strong> {{ $visitorDetails['email'] }}</li>
        <li><strong>Phone Number:</strong> {{ $visitorDetails['phone'] }}</li>
        <li><strong>ID Number:</strong> {{ $visitorDetails['id_number'] }}</li>
        <li><strong>Visit Type:</strong> {{ $visitorDetails['visit_type'] }}</li>
        <li><strong>Visit Facility:</strong> {{ $visitorDetails['visit_facility'] }}</li>
        <li><strong>Visit Date:</strong> {{ $visitorDetails['visit_date'] }}</li>
        <li><strong>Visit Time:</strong> {{ $visitorDetails['visit_from'] }} - {{ $visitorDetails['visit_to'] }}</li>
        <li><strong>Purpose of Visit:</strong> {{ $visitorDetails['purpose_of_visit'] }}</li>
        <li><strong>Host Name:</strong> {{ $visitorDetails['host_name'] }}</li>
    </ul>
    <p>Visitor Number: {{ $visitorNumber }}</p>
</body>
</html>
