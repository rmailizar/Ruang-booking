<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomBooking;
use App\Models\User;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $totalRooms = Room::count();
        $totalUsers = User::count();
        $totalBookings = RoomBooking::count();

        $query = Room::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhere('location', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%");
            });
        }

        // Filter capacity
        if ($request->filled('capacity_min')) {
            $query->where('capacity', '>=', $request->capacity_min);
        }
        if ($request->filled('capacity_max')) {
            $query->where('capacity', '<=', $request->capacity_max);
        }

        $rooms = $query->paginate(10)->appends($request->all());

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
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif',
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

        return redirect()->route('rooms.index')->with('success', 'Ruangan berhasil dibuat.');
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
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif',
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
        return redirect()->route('rooms.index')->with('success', 'Ruangan berhasil diupdate.');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Ruangan berhasil dihapus.');
    }
}
