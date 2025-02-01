<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visit Status</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheets" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <style>
        :root {
            --primary-color: #004080; /* Alupe's blue */
            --secondary-color: #ffcc00; /* Alupe's gold */
        }

        .bg-primary {
            background-color: var(--primary-color);
        }

        .text-primary {
            color: var(--primary-color);
        }

        .bg-secondary {
            background-color: var(--secondary-color);
        }

        .text-secondary {
            color: var(--secondary-color);
        }
    </style>
</head>
<x-app-layout>
    <div class="bg-white shadow-xl rounded-lg p-6 max-w-2xl mx-auto mt-10">
        <div class="border-b border-gray-200 pb-4 mb-4">
            <h2 class="text-2xl font-bold text-primary">Visit Status</h2>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <h3 class="font-semibold text-gray-700">Visitor Details</h3>
                <p>Number: {{ $visitor->visitor_number }}</p>
                <p>Name: {{ $visitor->first_name }} {{ $visitor->last_name }}</p>
                <p>Organization: {{ $visitor->organization }}</p>
            </div>
            <div>
                <h3 class="font-semibold text-gray-700">Host Details</h3>
                <p>Number: {{ $host->host_number }}</p>
                <p>Name: {{ $host->name }}</p>
                <p>Department: {{ $host->department }}</p>
            </div>

            <div class="col-span-2 mt-4">
                <h3 class="font-semibold text-gray-700">Visit Details</h3>
                <p>Date: {{ $visitor->visit_date }}</p>
                <p>Time: {{ $visitor->visit_from }} - {{ $visitor->visit_to }}</p>
                <p>Purpose: {{ $visitor->purpose_of_visit }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
    <form action="{{ route('visit.status') }}" method="POST" id="visit-status-form">
        @csrf
        <input type="hidden" name="visit_number" value="{{ $visit->visit_number }}">

        <!-- Meeting & Check-Out -->
        <section class="bg-white shadow-lg rounded-lg p-6 mb-12">
            <h3 class="text-2xl font-bold text-primary mb-4">Meeting & Check-Out</h3>

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
            body: JSON.stringify({ visitor_number: document.querySelector('input[name="visitor_number"]').value })
        })
        .then(response => response.json())
        .then(data => {
            alert('Check-out successful!.');
        });
    }
</script>
