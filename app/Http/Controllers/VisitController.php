<?php

namespace App\Http\Controllers;

use App\Models\Visitor; // import the Visit model
use App\Models\Host;
use App\Models\Feedback; // Import the Feedback model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log; // Import Log facade
use App\Mail\VisitBooked;
use App\Mail\VisitorJoined;
use App\Mail\HostVisitNotification; // Import the new HostVisitNotification class

class VisitController extends Controller
{
    public function showBookVisitForm()
    {
            $hosts = Host::all();
            return view('book-visit', compact('hosts'));
    }

    public function processBookVisit(Request $request)
    {
        // Validate request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:15',
            'id_number' => 'required|string|max:20',
            'visit_type' => 'required|string|max:255',
            'visit_facility' => 'required|string|max:255',
            'visit_date' => 'required|date',
            'visit_from' => 'required|date_format:H:i',
            'visit_to' => 'required|date_format:H:i',
            'purpose_of_visit' => 'required|string|max:255',
            'host_name' => 'required|string|max:255',
            'host_id' => 'required|exists:hosts,id', // Added host_id validation
        ]);

        // Generate a random visit number
        $visitNumber = rand(1000000000, 9999999999);

        // Save visitor details along with the visit number
        $visitor = Visitor::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'designation' => $request->designation,
            'organization' => $request->organization,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'id_number' => $request->id_number,
            'visit_type' => $request->visit_type,
            'visit_facility' => $request->visit_facility,
            'visit_date' => $request->visit_date,
            'visit_from' => $request->visit_from,
            'visit_to' => $request->visit_to,
            'purpose_of_visit' => $request->purpose_of_visit,
            'host_name' => $request->host_name,
            'visit_number' => $visitNumber,
        ]);

        // Retrieve host details
        $host = Host::find($request->host_id);
        if (!$host) {
            Log::error("Host not found for ID: " . $request->host_id);
            return redirect()->back()->withErrors(['host' => 'Host not found.']);
        }

        // Send email notifications to visitor and host
        Mail::to($visitor->email)->send(new VisitBooked($visitor, $visitNumber, $host));
        Mail::to($host->email)->send(new HostVisitNotification($visitor, $visitNumber, $host));

        // Return success response
        return redirect()->route('index')->with('success', "Visit booked successfully! Your visit number is: $visitNumber")->with('visit_number', $visitNumber);
    }


    public function joinVisit(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:15',
            'id_number' => 'required|string|max:20',
            'visit_number' => 'required|string',
        ]);

        // Find the visit by visit number
        $visit = Visitor::where('visit_number', $request->visit_number)->first();

        if (!$visit) {
            return redirect()->back()->withErrors(['visit_number' => 'Visit number not found.']);
        }

        // Save joining visitor details
        $joiningVisitor = Visitor::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'designation' => $request->designation,
            'organization' => $request->organization,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'id_number' => $request->id_number,
            'visit_number' => $request->visit_number,
        ]);

        // Send email notifications
        Mail::to($visit->email)->send(new VisitorJoined($joiningVisitor->toArray(), $visit->visit_number));
        Mail::to($visit->host->email)->send(new HostVisitNotification($joiningVisitor->toArray(), $visit->visit_number, $visit->host));

        // Return success response
        return redirect()->route('index')->with('success', "You have joined the visit successfully!");
    }

    public function submitFeedback(Request $request)
    {
        // Validate feedback data
        $request->validate([
            'visitor_id' => 'required|exists:visitors,id',
            'feedback' => 'required|string',
        ]);

        // Save feedback
        Feedback::create([
            'visitor_id' => $request->visitor_id,
            'feedback' => $request->feedback,
        ]);

        return redirect()->route('index')->with('success', 'Feedback submitted successfully!');
    }

    public function notifyHost(Request $request)
    {
        // Logic to notify the host
        $visit = Visitor::where('visit_number', $request->visit_number)->first();
        if ($visit) {
            Mail::to($visit->host->email)->send(new VisitorJoined($visit, $visit->visit_number));
            return response()->json(['message' => 'Host has been notified!']);
        }
        return response()->json(['message' => 'Visit number not found.'], 404);
    }
}
