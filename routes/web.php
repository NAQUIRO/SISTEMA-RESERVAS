<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('reservations.index');
})->name('reservations.index');

Route::get('/reservations/create', function () {
    return view('reservations.index');
})->name('reservations.create');
