<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VisitBooked; // Import the VisitBooked mailable
use App\Mail\CheckOutNotification; // Import the CheckOutNotification mailable
use App\Models\Visitor; // Visitor model
use App\Models\Host; // Host model
use App\Models\Feedback; // Feedback model
use App\Models\Visit; // Visit model

class VisitController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'host_name' => 'required|string|max:255',
            'visitor_name' => 'required|string|max:255',
            'visitor_email' => 'required|email|max:255',
            'visitor_phone' => 'required|string|max:15',
            'host_id' => 'required|exists:hosts,id',
        ]);

        $visitorNumber = rand(1000000000, 9999999999); // Generate a random visit number

        // Save visit details in the database
        $visit = Visit::create([
            'visit_number' => $visitorNumber,
            'host_name' => $validatedData['host_name'],
            'visitor_name' => $validatedData['visitor_name'],
            'visitor_email' => $validatedData['visitor_email'],
            'visitor_phone' => $validatedData['visitor_phone'],
            'host_id' => $validatedData['host_id'],
        ]);

        // Get the host's email from the database
        $hostEmail = $this->getHostEmail($validatedData['host_name']);

        // Prepare host email content
        $hostEmailContent = [
            'first_name' => $validatedData['visitor_name'],
            'last_name' => '',
            'designation' => '',
            'organization' => '',
            'email' => $validatedData['visitor_email'],
            'phone' => $validatedData['visitor_phone'],
            'id_number' => '',
            'visit_type' => '',
            'visit_facility' => '',
            'visit_date' => '',
            'visit_from' => '',
            'visit_to' => '',
            'purpose_of_visit' => '',
            'host_name' => $validatedData['host_name'],
            'visitor_number' => $visitorNumber,
        ];

        // Send email to host
        Mail::to($hostEmail)->send(new VisitBooked($hostEmailContent, $visitorNumber));

        // Redirect back to index with success message
        return redirect('/')->with('success', "Dear {$validatedData['visitor_name']}, your details for the Visit submitted successfully. Visit no. {$visitorNumber}");
    }

    public function showVisitStatus(Request $request)
    {
        $visitNumber = $request->input('visit_number');
        $visit = Visit::where('visit_number', $visitNumber)->first();

        if (!$visit) {
            return redirect()->back()->with('error', 'Visit not found.');
        }

        $host = Host::find($visit->host_id);

        return view('visit-status', ['visit' => $visit, 'host' => $host]);
    }

    public function notifyHost(Request $request)
    {
        $visitNumber = $request->input('visit_number');
        $visit = Visit::where('visit_number', $visitNumber)->first();

        if (!$visit) {
            return response()->json(['error' => 'Visit not found.'], 404);
        }

        $host = Host::find($visit->host_id);

        return response()->json(['email' => $host->email, 'phone' => $host->phone]);
    }

    public function checkOut(Request $request)
    {
        $visitNumber = $request->input('visit_number');
        $visit = Visit::where('visit_number', $visitNumber)->first();

        if (!$visit) {
            return response()->json(['error' => 'Visit not found.'], 404);
        }

        $host = Host::find($visit->host_id);

        // Send email notifications
        Mail::to($visit->visitor_email)->send(new CheckOutNotification($visit, $host));
        Mail::to($host->email)->send(new CheckOutNotification($visit, $host));

        return response()->json(['message' => 'Check-out successful!']);
    }

    public function saveFeedback(Request $request)
    {
        // Validate feedback data
        $validatedData = $request->validate([
            'visitor_id' => 'required|integer',
            'feedback' => 'required|string|max:500',
        ]);

        // Save feedback to the database
        Feedback::create($validatedData);

        return response()->json(['message' => 'Feedback saved successfully.']);
    }

    private function getHostEmail($hostName)
    {
        $host = Host::where('name', $hostName)->first();
        return $host ? $host->email : null;
    }
}