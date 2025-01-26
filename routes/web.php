<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/book-visit', function () {
    return view('book-visit');
})->name('book-visit');

Route::get('/join-visit', function () {
    return view('join-visit');
})->name('join-visit');