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
        $rooms = Room::paginate('10');

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
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('user_images', 'public');
        } else {
            $imagePath = null;
        }

        Room::create([
            'name'         => $request->name,
            'location'     => $request->location,
            'capacity'     => $request->capacity,
            'description'  => $request->description,
            'image'        => $imagePath,
        ]);

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
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('room_images', 'public');
            $room->image = $imagePath; // update image jika ada file baru
        }

        $room->update([
            'name'         => $request->name,
            'location'     => $request->location,
            'capacity'     => $request->capacity,
            'description'  => $request->description,
        ]);
        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }
}
