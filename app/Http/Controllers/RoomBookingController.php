<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomBooking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\RoomBookingsExport;
use Maatwebsite\Excel\Facades\Excel;

class RoomBookingController extends Controller
{
    public function index()
    {
        $totalRooms = Room::count();
        $totalUsers = User::count();
        $totalBookings = RoomBooking::count();
        $bookings = RoomBooking::with(['user', 'room'])->get();

        return view('admin.show_booking', compact('bookings', 'totalRooms', 'totalUsers', 'totalBookings'));
    }

    public function roomList()
    {
        $totalRooms = Room::count();
        $totalUsers = User::count();
        $totalBookings = RoomBooking::count();
        $rooms = Room::all();
        return view('admin.booking',  compact('rooms', 'totalRooms', 'totalUsers', 'totalBookings'));
    }

    public function myBookings()
    {
        $user = Auth::user();
        $userId = Auth::id();
        $bookings = RoomBooking::with(['room', 'user'])
            ->where('user_id', $userId)
            ->orderBy('start_time', 'desc')
            ->get();         
            if ($user->role === 'admin') {
                return view('admin.my_booking', compact('bookings'));
            } else {
                return view('user.my_booking', compact('bookings'));
            }
    }

    public function export(Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');
    
        $filename = 'room_bookings_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new RoomBookingsExport($start, $end), $filename);
    }

    public function create(Request $request)
    {
        $room = Room::findOrFail($request->room_id);
        return view('admin.create_booking', compact('room'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'jml_peserta' => 'required|integer|min:1',
            'reason' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);
    
        $room = Room::findOrFail($request->room_id);
    
        if ($request->jml_peserta > $room->capacity) {
            return back()->withErrors(['jml_peserta' => 'Jumlah peserta melebihi kapasitas ruangan.'])->withInput();
        }
    
        $conflict = RoomBooking::where('room_id', $request->room_id)
            ->where('status', 'approved')
            ->where(function($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                      ->orWhere(function($q) use ($request) {
                          $q->where('start_time', '<=', $request->start_time)
                            ->where('end_time', '>=', $request->end_time);
                      });
            })
            ->exists();
    
        if ($conflict) {
            return back()->withErrors(['start_time' => 'Ruangan sudah dibooking pada waktu tersebut.'])->withInput();
        }
    
        RoomBooking::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'jml_peserta' => $request->jml_peserta,
            'catatan' => $request->catatan,
            'status' => 'pending',
            'reason' => $request->reason,
        ]);
    
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.my_bookings')->with('success', 'Peminjaman berhasil diajukan.');
        } else {
            return redirect()->route('user.my_bookings')->with('success', 'Peminjaman berhasil diajukan.');
        }

    }

    

    public function updateStatus(Request $request, RoomBooking $booking)
    {
        $request->validate(['status' => 'required|in:approved,rejected']);

        $booking->update([
            'status' => $request->status
        ]);

        return redirect()->route('bookings.index')->with('success', 'Status diperbarui.');
    }

    // Hapus booking
    public function destroy(RoomBooking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking dihapus.');
    }
}
