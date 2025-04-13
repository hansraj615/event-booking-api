<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AttendeeController;
use App\Http\Controllers\BookingController;

Route::apiResource('events', EventController::class);
Route::apiResource('attendees', AttendeeController::class);
Route::post('bookings', [BookingController::class, 'store']);
