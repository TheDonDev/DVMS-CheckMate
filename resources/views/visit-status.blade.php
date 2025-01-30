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

    <p>Date: {{ $visit->visit_date }}</p>
    <p>Visitors:</p>
    <ul>
        <li>Name: {{ $visit->visitor_name }}</li>
        <li>Email: {{ $visit->visitor_email }}</li>
        <li>Host Phone: {{ $visit->host_phone }}</li> <!-- Added host phone number -->
    </ul>
    <form action="{{ route('visit.status') }}" method="POST">
    @csrf
    <input type="hidden" name="visit_number" value="{{ $visit->visit_number }}">

    <!-- Meeting & Check-Out -->
    <section class="bg-white shadow-lg rounded-lg p-6 mb-12">
        <h3 class="text-2xl font-bold text-primary mb-4">Meeting & Check-Out</h3>
        <button class="mt-4 bg-primary text-white px-4 py-2 rounded" type="submit">Book Visit</button>
        <button class="mt-4 bg-primary text-white px-4 py-2 rounded" type="button" onclick="notifyHost()">Notify Host</button>
        <button class="mt-4 bg-primary text-white px-4 py-2 rounded" type="button" onclick="checkOut()">Check Out</button>
    </section>
</form>

    <script>
    function notifyHost() {
        // Fetch host details and show in a popup
        fetch('{{ route('notify.host') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ visit_number: document.querySelector('input[name="visit_number"]').value })
        })
        .then(response => response.json())
        .then(data => {
            alert(`Host Email: ${data.email}\nHost Phone: ${data.phone}`);
        });
    }

    function checkOut() {
        // Send checkout request
        fetch('{{ route('checkout') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ visit_number: document.querySelector('input[name="visit_number"]').value })
        })
        .then(response => response.json())
        .then(data => {
            alert('Check-out successful!.');
        });
    }
</script>