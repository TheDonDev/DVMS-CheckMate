<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitController;
use Illuminate\Support\Facades\Mail;

// Routes for Visit Status
Route::get('/visit-status', function () {
    return view('visit-status');
})->name('visit.status');

Route::post('/visit-status', [VisitController::class, 'showVisitStatus'])->name('visit.status');

// Route to check out
Route::post('/checkout', [VisitController::class, 'checkOut'])->name('checkout');

// Test route for sending a test email
Route::get('/test-email', function () {
    $details = [
        'first_name' => 'Test',
        'last_name' => 'User',
        'email' => 'donaldmwanga33@gmail.com',
    ];
    try {
        Mail::to($details['email'])->send(new \App\Mail\VisitBooked($details, '1234512345', 'example.com'));
        return 'Email sent successfully!';
    } catch (\Exception $e) {
        return 'Error sending email: ' . $e->getMessage();
    }
});

Route::get('/', function () {
    return view('index');
})->name('index');

// Routes for booking a visit
Route::get('book-visit', [VisitController::class, 'showBookVisitForm'])->name('book.visit');
Route::post('book-visit', [VisitController::class, 'processBookVisit'])->name('book.visit.submit');

// Routes for joining a visit
Route::get('join-visit', function () {
    return view('join-visit');
})->name('join.visit');

Route::post('/join-visit', [VisitController::class, 'processJoinVisit'])->name('join.visit.submit');

// Route for notifying the host
Route::post('/notify-host', [VisitController::class, 'notifyHost'])->name('notify.host');

// Route for saving feedback
Route::post('/save-feedback', [VisitController::class, 'submitFeedback'])->name('save.feedback');
