<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VisitBooked; // Import the VisitBooked mailable
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
        // Validate the visit number
        $request->validate([
            'visit_number' => 'required|integer',
        ]);

        // Retrieve visit details based on the visit number
        $visit = Visit::where('visitor_number', $request->visit_number)->first();

        if (!$visit) {
            return redirect('/')->with('error', 'Visit not found.');
        }

        return view('visit-status', compact('visit'));
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

    public function getHostEmail($hostName)
    {
        // Retrieve the host's email from the database
        $host = Host::where('name', $hostName)->first();
        if (!$host) {
            dd("Host not found: " . $hostName);
        }
        return $host ? $host->email : null; // Return the email if found, otherwise null
    }

    // Other methods remain unchanged...
}
