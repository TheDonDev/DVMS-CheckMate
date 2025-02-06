@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold">Visit Status</h1>
    <p>Your visit number is: {{ session('visit_number') }}</p>
    <p>Host Name: {{ $host->name ?? 'Not assigned' }}</p>
    <p>Host Email: {{ $host->email ?? 'Not assigned' }}</p>
    <p>Host Number: {{ $host->number ?? 'Not assigned' }}</p>
    <p>Purpose of Visit: {{ $visit->purpose_of_visit ?? 'Not specified' }}</p>
    <p>Visit Facility: {{ $visit->visit_facility ?? 'Not specified' }}</p>
    <p>Date: {{ $visit->created_at->format('Y-m-d') ?? 'Not specified' }}</p>
    <p>Time: {{ $visit->visit_from }} - {{ $visit->visit_to }}</p>
    <p>Total Visitors: {{ $totalVisitors ?? 0 }}</p>
    <h2 class="text-xl font-bold">Joining Visitors:</h2>
    <ul>
        @foreach($joiningVisitors as $visitor)
            <li>{{ $visitor->name }} - {{ $visitor->email }} - {{ $visitor->phone_number }}</li>
        @endforeach
    </ul>
    <button onclick="notifyHost()" class="mt-4 bg-primary text-white px-4 py-2 rounded">Notify Host</button>
</div>

<script>
function notifyHost() {
    // Logic to notify the host
    alert('Host has been notified!');
}
</script>
@endsection
