<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Attendee;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|integer',
            'attendee_id' => 'required|integer',
        ]);

        $event = Event::find($validated['event_id']);
        $attendee = Attendee::find($validated['attendee_id']);

        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        if (!$attendee) {
            return response()->json(['error' => 'Attendee not found'], 404);
        }

        $alreadyBooked = Booking::where([
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ])->exists();

        if ($alreadyBooked) {
            return response()->json(['error' => 'Already booked'], 409);
        }

        if ($event->bookings()->count() >= $event->capacity) {
            return response()->json(['error' => 'Event is full'], 400);
        }

        $booking = Booking::create([
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        return response()->json($booking, 201);
    }
}
