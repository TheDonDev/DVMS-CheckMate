<?php

namespace App\Http\Controllers;

use App\Models\Visit; // import the Visit model
use App\Models\Host;
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
                'phone' => 'required|string|max:15',
                'id_number' => 'required|string|max:20',
                'visit_type' => 'required|string',
                'visit_facility' => 'required|string',
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

            // Send email to visitor
            Mail::to($validatedData['email'])->send(new VisitBooked($validatedData, $visitNumber));

            // Get host email
            $hostEmail = Host::where('name', $validatedData['host_name'])->value('email');

            // Send email to host
            Mail::to($hostEmail)->send(new VisitBooked($validatedData, $visitNumber));

            // Save the visitor data to the database
            Visit::create([
                'visit_id' => $validatedData['visit_id'],
                'visit_number' => $visitNumber, // Updated to visit_number
                'host_name' => $validatedData['host_name'],
                'visitor_name' => "{$validatedData['first_name']} {$validatedData['last_name']}",
                'visitor_email' => $validatedData['email'],
                'visitor_phone' => $validatedData['phone'],
                'id_number' => $validatedData['id_number'],
                'designation' => $validatedData['designation'],
                'organization' => $validatedData['organization'],
                'visit_type' => $validatedData['visit_type'],
                'visit_facility' => $validatedData['visit_facility'],
                'visit_date' => $validatedData['visit_date'],
                'visit_from' => $validatedData['visit_from'],
                'visit_to' => $validatedData['visit_to'],
                'purpose_of_visit' => $validatedData['purpose_of_visit']
            ]);

            // Redirect back to index with success message
            return redirect('/')->with('success', "Dear {$validatedData['first_name']}, your details for the Visit submitted successfully. Visit no. {$visitNumber}. You can share this visit number to let someone else join the visit.")
                                ->with('visit_number', $visitNumber); // Updated to visit_number
        } catch (\Exception $e) {
            Log::error('Error processing booking visit: ' . $e->getMessage());
            return redirect('/')->with('error', 'There was an error processing your visit. Please try again.');
        }
    }

    public function showVisitStatus(Request $request)
    {
        $visitNumber = $request->input('visit_number'); // Updated to visit_number
        Log::info('Checking visit status for visit number: ' . $visitNumber);

        $visit = Visit::where('visit_number', $visitNumber)->first(); // Updated to visit_number

        if (!$visit) {
            Log::warning('Visit not found for visit number: ' . $visitNumber);
            return redirect('/')->with('error', 'Visit not found.');
        }

        $host = Host::find($visit->host_id);
        return view('visit-status', ['visit' => $visit, 'host' => $host]);
    }

    private function getHostId($hostName)
    {
        $host = Host::where('name', $hostName)->first();
        return $host ? $host->id : null; // Return null if host not found
    }
}
