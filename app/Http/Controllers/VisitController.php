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
    public function processBookVisit(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'id_number' => 'required|string|max:20',
            'visit_type' => 'required|string',
            'visit_facility' => 'required|string',
            'visit_date' => 'required|date',
            'visit_from' => 'required|string',
            'visit_to' => 'required|string',
            'purpose_of_visit' => 'required|string',
            'host_name' => 'required|string',
        ]);

        // Generate a random visitor number
        $visitorNumber = rand(1000000000, 9999999999);

        // Send email to visitor
        Mail::to($validatedData['email'])->send(new VisitBooked($validatedData, $visitorNumber));

        // Get the host's email from the database
        $hostEmail = $this->getHostEmail($validatedData['host_name']);

        // Prepare host email content
        $hostEmailContent = [
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'designation' => $validatedData['designation'],
            'organization' => $validatedData['organization'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'id_number' => $validatedData['id_number'],
            'visit_type' => $validatedData['visit_type'],
            'visit_facility' => $validatedData['visit_facility'],
            'visit_date' => $validatedData['visit_date'],
            'visit_from' => $validatedData['visit_from'],
            'visit_to' => $validatedData['visit_to'],
            'purpose_of_visit' => $validatedData['purpose_of_visit'],
            'host_name' => $validatedData['host_name'],
            'visitor_number' => $visitorNumber,
        ];

        // Send email to host
        Mail::to($hostEmail)->send(new VisitBooked($hostEmailContent, $visitorNumber));

        // Redirect back to index with success message
        return redirect('/')->with('success', "Dear {$validatedData['first_name']}, your details for the Visit submitted successfully. Visit no. {$visitorNumber}");
    }

    public function showVisitStatus(Request $request)
    {
        $visitNumber = $request->input('visit_number');
        $visit = Visit::where('visit_number', $visitNumber)->first();
        $host = Host::find($visit->host_id);

        return view('visit-status', ['visit' => $visit, 'host' => $host]);
    }

    public function notifyHost(Request $request)
    {
        $visitNumber = $request->input('visit_number');
        $visit = Visit::where('visit_number', $visitNumber)->first();
        $host = Host::find($visit->host_id);

        return response()->json(['email' => $host->email, 'phone' => $host->phone]);
    }

    public function checkOut(Request $request)
    {
        $visitNumber = $request->input('visit_number');
        $visit = Visit::where('visit_number', $visitNumber)->first();
        $host = Host::find($visit->host_id);

        // Send email notifications
        Mail::to($visit->email)->send(new CheckOutNotification($visit, $host));
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