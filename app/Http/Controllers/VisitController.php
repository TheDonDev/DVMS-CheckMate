<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VisitBooked; // Ensure you import the VisitBooked mailable
use App\Mail\VisitorJoined; // Import the mailable for joining a visit
use App\Models\Visitor; // Assuming you have a Visitor model to interact with the database
use App\Models\Host; // Import the Host model

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

        // Remove debugging statement to allow form submission to complete

        // Generate a random visitor number
        $visitorNumber = rand(1000000000, 9999999999);

        // Send email to visitor
        Mail::to($validatedData['email'])->send(new VisitBooked($validatedData, $visitorNumber));

        // Get the host's email from the database (assuming you have a Host model)
        $hostEmail = $this->getHostEmail($validatedData['host_name']); // Implement this method to get the host's email

        // Remove debugging statement to allow form submission to complete

        Mail::to($hostEmail)->send(new VisitBooked($validatedData, $visitorNumber));

        // Redirect back to index with success message
        return redirect('/')->with('success', "Your details for the Tour submitted successfully. Visit no. {$visitorNumber}");
    }

    public function processJoinVisit(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'visit_number' => 'required|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'id_number' => 'required|string|max:20',
            'organization' => 'required|string|max:255',
        ]);

        // Find the original visitor by visit number
        $originalVisitor = Visitor::where('visit_number', $validatedData['visit_number'])->first();

        if (!$originalVisitor) {
            return redirect('/')->with('error', "Visit number not found.");
        }

        // Send email to the original visitor notifying them that someone joined their visit
        Mail::to($originalVisitor->email)->send(new VisitorJoined($validatedData));

        // Get the host's email from the database
        $hostEmail = $this->getHostEmail($originalVisitor->host_name);
        Mail::to($hostEmail)->send(new VisitorJoined($validatedData));

        // Redirect back to index with success message
        return redirect('/')->with('success', "You have successfully joined the visit.");
    }

    private function getHostEmail($hostName)
    {
        // Retrieve the host's email from the database
        $host = Host::where('name', $hostName)->first();
        return $host ? $host->email : null; // Return the email if found, otherwise null
    }
}
