<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitController;

// Routes for Visit Status
Route::get('/visit-status', [VisitController::class, 'showVisitStatus'])->name('visit.status');

// Route to notify host via AJAX
Route::post('/notify-host', [VisitController::class, 'notifyHost'])->name('notify.host');
//     return view('visit-status');
// })->name('visit.status');


// Routes for Homepage
Route::get('/', function () {
    return view('index');
})->name('index');


// Routes for booking a visit
Route::get('book-visit', function () {
    return view('book-visit');
})->name('book.visit');

Route::post('book-visit', [VisitController::class, 'processBookVisit'])->name('book.visit.submit');

// Routes for joining a visit
Route::get('join-visit', function () {
    return view('join-visit');
})->name('join.visit');

Route::post('/join-visit', [VisitController::class, 'processJoinVisit'])->name('join.visit.submit');