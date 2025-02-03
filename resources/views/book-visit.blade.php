@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold">Book a Visit</h1>
    <form action="{{ route('book.visit') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="first_name" class="block">First Name</label>
            <input type="text" name="first_name" id="first_name" required class="border rounded w-full">
        </div>
        <div>
            <label for="last_name" class="block">Last Name</label>
            <input type="text" name="last_name" id="last_name" required class="border rounded w-full">
        </div>
        <div>
            <label for="email" class="block">Email</label>
            <input type="email" name="email" id="email" required class="border rounded w-full">
        </div>
        <div>
            <label for="phone_number" class="block">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" required class="border rounded w-full">
        </div>
        <div>
            <label for="visit_type" class="block">Visit Type</label>
            <select name="visit_type" id="visit_type" required class="border rounded w-full">
                <option value="Business">Business</option>
                <option value="Official">Official</option>
                <option value="Educational">Educational</option>
                <option value="Social">Social</option>
                <option value="Tour">Tour</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div>
            <label for="feedback" class="block">Feedback</label>
            <textarea name="feedback" id="feedback" class="border rounded w-full" rows="4" placeholder="Your feedback..."></textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2">Submit</button>
    </form>
</div>
@endsection
