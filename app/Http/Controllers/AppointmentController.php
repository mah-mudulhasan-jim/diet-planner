<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // Processes the booking form
    public function store(Request $request)
    {
        // 1. Validate the incoming data
        $validated = $request->validate([
            'nutritionist_id' => 'required|exists:users,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'notes' => 'nullable|string|max:1000',
        ]);

        // 2. Combine the separate Date and Time inputs into one DateTime string for the database
        $scheduledAt = $validated['date'] . ' ' . $validated['time'];

        // 3. Save the appointment to the database
        Appointment::create([
            'user_id' => $request->user()->id, // The currently logged-in user
            'nutritionist_id' => $validated['nutritionist_id'],
            'scheduled_at' => $scheduledAt,
            'status' => 'pending', // Starts as pending until the expert confirms
            'notes' => $validated['notes'],
        ]);

        // 4. Redirect back to the profile with a success message
        return back()->with('success', 'Your appointment request has been sent! The expert will review it shortly.');
    }

    // Shows the list of appointments for the logged-in user
    public function index(Request $request)
    {
        $user = $request->user();

        // If the user is a nutritionist, they see requests sent to them
        if ($user->role === 'nutritionist') {
            $appointments = Appointment::where('nutritionist_id', $user->id)
                ->with('user')
                ->orderBy('scheduled_at', 'asc')
                ->get();
        } else {
            // Normal users see appointments they booked
            $appointments = Appointment::where('user_id', $user->id)
                ->with('nutritionist')
                ->orderBy('scheduled_at', 'asc')
                ->get();
        }

        return view('appointments.index', compact('appointments'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        // Only the assigned nutritionist can update the status
        if ($request->user()->id !== $appointment->nutritionist_id) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:confirmed,cancelled'
        ]);

        $appointment->update([
            'status' => $validated['status']
        ]);

        return back()->with('success', 'Appointment status updated to ' . $validated['status'] . '.');
    }
}