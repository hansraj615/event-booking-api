<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendee;

class AttendeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Attendee::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:attendees,email',
        ]);

        $attendee = Attendee::create($validated);

        return response()->json($attendee, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendee $attendee)
    {
        return response()->json($attendee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendee $attendee)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:attendees,email,' . $attendee->id,
        ]);

        $attendee->update($validated);

        return response()->json($attendee);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendee $attendee)
    {
        $attendee->delete();

        return response()->json(['message' => 'Attendee deleted']);
    }
}
