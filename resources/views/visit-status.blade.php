<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visit Status</title>
</head>
<body>
    <h1>Visit Status</h1>
    <p>Host Phone: {{ $visit->host_phone }}</p> <!-- Added host phone number -->

    <p>Host Phone: {{ $visit->host_phone }}</p> <!-- Added host phone number -->

    <p>Date: {{ $visit->visit_date }}</p>
    <p>Visitors:</p>
    <ul>
        <li>Name: {{ $visit->visitor_name }}</li>
        <li>Email: {{ $visit->visitor_email }}</li>
        <li>Host Phone: {{ $visit->host_phone }}</li> <!-- Added host phone number -->
    </ul>
    <button id="check-in">Check In</button>
    <button id="notify-host">Notify Host</button>
    <button id="check-out">Check Out</button>

    <script>
        document.getElementById('notify-host').addEventListener('click', function() {
            const hostEmail = '{{ $visit->host_email }}'; // Get host email
            // Logic to send email to host
            alert(`Email sent to host at ${hostEmail}`);
        });

        document.getElementById('check-out').addEventListener('click', function() {
            // Logic to notify host of check-out
            alert('Host notified of check-out.');
        });
    </script>

    <button id="notify-host">Notify Host</button>
    <button id="check-out">Check Out</button>

    <script>
        document.getElementById('notify-host').addEventListener('click', function() {
            const hostEmail = '{{ $visit->host_email }}'; // Get host email
            // Logic to send email to host
            alert(`Email sent to host at ${hostEmail}`);
        });

        document.getElementById('check-out').addEventListener('click', function() {
            // Logic to notify host of check-out
            alert('Host notified of check-out.');
        });
    </script>

    <button id="notify-host">Notify Host</button>
    <button id="check-out">Check Out</button>

    <script>
        document.getElementById('notify-host').addEventListener('click', function() {
            const hostEmail = '{{ $visit->host_email }}'; // Get host email
            // Logic to send email to host
            alert(`Email sent to host at ${hostEmail}`);
        });

        document.getElementById('check-out').addEventListener('click', function() {
            // Logic to notify host of check-out
            alert('Host notified of check-out.');
        });
    </script>
</body>
</html>
