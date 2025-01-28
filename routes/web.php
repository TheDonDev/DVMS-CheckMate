<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitController;

// Home route
Route::get('/', function () {
    return view('index');
});

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