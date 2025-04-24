<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomBooking;
use App\Models\User;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $totalRooms = Room::count();
        $totalUsers = User::count();
        $totalBookings = RoomBooking::count();
        $rooms = Room::all();

        return view('admin.show_room', compact('rooms', 'totalRooms', 'totalUsers', 'totalBookings'));

    }

    public function show(Room $room)
    {
        return view('admin.show_room', compact('room'));
    }

    public function create()
    {
        return view('admin.create_room');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'capacity' => 'required|integer',
        ]);

        Room::create($request->all());
        return redirect()->route('rooms.index')->with('success', 'Room created successfully.');
    }

    public function edit(Room $room)
    {
        return view('admin.edit_room', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'capacity' => 'required|integer',
        ]);

        $room->update($request->all());
        return redirect()->route('admin.dashboard')->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }
}
