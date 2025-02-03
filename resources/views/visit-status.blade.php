@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold">Visit Status</h1>
    <p>Your visit number is: {{ session('visit_number') }}</p>
    <p>Host Number: {{ $host_number ?? 'Not assigned' }}</p>
    <p>Feedback: {{ session('feedback') ?? 'No feedback provided' }}</p>
</div>
@endregion
