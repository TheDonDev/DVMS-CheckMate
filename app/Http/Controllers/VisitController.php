<?php

namespace App\Http\Controllers;

use App\Models\Visitor; // import the Visit model
use App\Models\Host;
use App\Models\Feedback; // Import the Feedback model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log; // Import Log facade
use App\Mail\VisitBooked;

class VisitController extends Controller
{
    public function processBookVisit(Request $request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'visit_id' => 'required|string',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'designation' => 'required|string|max:255',
                'organization' => 'required|string|max:255',
                'email' => 'required|email',
                'phone_number' => 'required|string|max:15',
                'id_number' => 'required|string|max:20',
                'visit_type' => 'required|string|in:Business,Official,Educational,Social,Tour,Other',
                'visit_facility' => 'required|string|in:Library,Administration Block,Science Block,Auditorium,SHS',
                'visit_date' => 'required|date',
                'visit_from' => 'required|string',
                'visit_to' => 'required|string',
                'purpose_of_visit' => 'required|string',
                'host_name' => 'required|string'
            ]);

            // Log the validated data
            Log::info('Validated Data:', $validatedData);

            // Generate a random visit number
            $visitNumber = rand(1000000000, 9999999999);
            $hostEmail = Host::where('name', $validatedData['host_name'])->value('email');

            // Create a new host if not exists
            if (!$hostEmail) {
                Host::create([
                    'host_name' => $validatedData['host_name'],
                    'host_email' => $validatedData['email'],
                    'host_number' => $validatedData['phone_number']
                ]);
            }

            // Send email to visitor and log the action
            Log::info('Sending email to visitor: ' . $validatedData['email']);
            Mail::to($validatedData['email'])->send(new VisitBooked($validatedData, $visitNumber));

            // Get host email again after creation
            $hostEmail = Host::where('name', $validatedData['host_name'])->value('email');

            // Check if host email is found
            if (!$hostEmail) {
                Log::error('Host email not found for host name: ' . $validatedData['host_name']);
                return redirect('/')->with('error', 'Host email not found. Please check the host name.');
            }

            // Send email to host
            Mail::to($hostEmail)->send(new VisitBooked($validatedData, $visitNumber));

            // Save the visitor data to the database and log the action
            Visitor::create([
                'visit_id' => $validatedData['visit_id'],
                'visit_number' => $visitNumber,
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'email' => $validatedData['email'],
                'phone_number' => $validatedData['phone_number'],
                'id_number' => $validatedData['id_number'],
                'designation' => $validatedData['designation'],
                'organization' => $validatedData['organization'],
                'visit_type' => $validatedData['visit_type'],
                'visit_facility' => $validatedData['visit_facility'],
                'visit_date' => $validatedData['visit_date'],
                'visit_from' => $validatedData['visit_from'],
                'visit_to' => $validatedData['visit_to'],
                'purpose_of_visit' => $validatedData['purpose_of_visit'],
                'host_name' => $validatedData['host_name'],
            ]);
            Log::info('Saving visitor data to the database:', $validatedData);

            // Redirect back to index with success message
            session(['visit_number' => $visitNumber]);
            return redirect('/')->with('success', "Dear {$validatedData['first_name']}, your details for the Visit submitted successfully. Visit no. {$visitNumber}. You can share this visit number to let someone else join the visit.")
                                ->with('visit_number', $visitNumber)
                                ->with('error', null);
        } catch (\Exception $e) {
            Log::error('Error processing booking visit: ' . $e->getMessage());
            return redirect('/')->with('error', 'There was an error processing your visit. Please try again.');
        }
    }

    public function saveFeedback(Request $request)
    {
        $validatedData = $request->validate([
            'feedback' => 'required|string|max:1000',
            'visit_number' => 'required|string',
        ]);

        // Log the feedback submission
        Log::info('Feedback submitted for visit number: ' . $validatedData['visit_number'], $validatedData);

        // Save feedback to the database (assuming a Feedback model exists)
        Feedback::create([
            'visit_number' => $validatedData['visit_number'],
            'feedback' => $validatedData['feedback'],
        ]);

        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }
}
