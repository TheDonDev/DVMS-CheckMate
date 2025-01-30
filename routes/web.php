<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitController;
use Illuminate\Support\Facades\Mail;

// Routes for Visit Status
Route::post('/visit-status', [VisitController::class, 'showVisitStatus'])->name('visit.status');

// Route to notify host via AJAX
Route::post('/notify-host', [VisitController::class, 'notifyHost'])->name('notify.host');

// Route to check out
Route::post('/checkout', [VisitController::class, 'checkOut'])->name('checkout');

// Test route for sending a test email
Route::get('/test-email', function () {
    $details = [
        'first_name' => 'Test',
        'last_name' => 'User',
        'email' => 'donaldmwanga33gmail.com@',
    ];
    Mail::to($details['email'])->send(new \App\Mail\VisitBooked($details, '1234567890'));
    return 'Email sent successfully!';
});


Route::get('/', function () {
    return view('index');
})->name('index');


// Routes for booking a visit
Route::get('book-visit', function () {
    return view('book-visit');
})->name('book.visit');

Route::post('book-visit', [VisitController::class, 'store'])->name('book.visit.submit');

// Routes for joining a visit
Route::get('join-visit', function () {
    return view('join-visit');
})->name('join.visit');

Route::post('/join-visit', [VisitController::class, 'processJoinVisit'])->name('join.visit.submit');