<?php

namespace App\Http\Controllers;

use App\Models\RoomBooking;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        return view('booking.calendar');
    }

    public function getBookings()
    {
        $events = RoomBooking::with(['user', 'room'])
        ->where('status', 'approved')
        ->get()
        ->map(function ($booking) {
            return [
                'id' => $booking->id,
                'title' => $booking->room->name . ' - ' . $booking->user->name,
                'start' => $booking->start_time,
                'end' => $booking->end_time,
                'color' => '#28a745',
            ];
        });

        return response()->json($events);
    }

    public function showBookingDetail($id)
    {
        $booking = RoomBooking::with(['user', 'room'])->findOrFail($id);
    
        return response()->json([
            'user' => $booking->user->name,
            'email' => $booking->user->email,
            'room' => $booking->room->name,
            'location' => $booking->room->location,
            'start' => $booking->start_time,
            'end' => $booking->end_time,
            'reason' => $booking->reason,
        ]);
    }
    
}
