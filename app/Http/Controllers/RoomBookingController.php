<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomBooking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\RoomBookingsExport;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class RoomBookingController extends Controller
{
    public function index(Request $request)
    {
        $totalRooms = Room::count();
        $totalBookings = RoomBooking::count();
        $query = RoomBooking::with(['user', 'room']);

        if ($request->filled('search')) {
            $search = $request->search;
        
            $query->where(function ($q) use ($search) {
                // Cari berdasarkan user
                $q->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%$search%")
                              ->orWhere('nim', 'like', "%$search%");
                });
        
                // Atau cari berdasarkan ruangan
                $q->orWhereHas('room', function ($roomQuery) use ($search) {
                    $roomQuery->where('name', 'like', "%$search%")
                              ->orWhere('location', 'like', "%$search%");
                });
            });
        }
    
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $start = $request->start_date . ' 00:00:00';
            $end = $request->end_date . ' 23:59:59';
            $query->whereBetween('start_time', [$start, $end]);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        $bookings = $query->orderBy('start_time', 'desc')->paginate(10);

        return view('admin.show_booking', compact('bookings', 'totalRooms', 'totalBookings'));
    }

    public function roomList(Request $request)
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

        return view('booking.booking',  compact('rooms', 'totalRooms', 'totalUsers', 'totalBookings'));
    }

    public function myBookings()
    {
        $user = Auth::user();
        $userId = Auth::id();
        $bookings = RoomBooking::with(['room', 'user'])
            ->where('user_id', $userId)
            ->orderBy('start_time', 'desc')
            ->paginate(10);         

        return view('booking.my_booking', compact('bookings'));
    }

    public function roomDetail($id)
    {
        $room = Room::findOrFail($id);
        $bookings = RoomBooking::where('room_id', $id)
                ->where('status', 'approved')
                ->orderBy('start_time', 'asc')
                ->paginate(10);
        return view('booking.room_detail', compact('room', 'bookings'));
    }

    public function export(Request $request)
    {
        $start = $request->input('start_date') ? $request->input('start_date') . ' 00:00:00' : null;
        $end = $request->input('end_date') ? $request->input('end_date') . ' 23:59:59' : null;
        $status = $request->input('status');

        $filename = 'Laporan_bookings_' . now()->format('Ymd_His') . '.xlsx';
        
        return Excel::download(new RoomBookingsExport($start, $end, $status), $filename);
    }

    public function create(Request $request)
    {
        $room = Room::findOrFail($request->room_id);
        $bookings = RoomBooking::where('room_id', $room->id)
        ->where('status', 'approved')
        ->orderBy('start_time', 'asc')
        ->paginate(10);
        
        return view('admin.create_booking', compact('room', 'bookings'));
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

        if (Carbon::parse($request->end_time)->lt(now())) {
            session()->flash('invalid_date', 'Tanggal booking sudah lewat dan tidak valid.');
            return back()->withInput();
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

        return redirect()->route('bookings.myBookings')->with('success', 'Peminjaman berhasil diajukan.');
    }

    public function edit(RoomBooking $booking)
    {
        $rooms = Room::all(); 
        return view('admin.edit_booking', compact('booking', 'rooms'));
    }

    public function update(Request $request, RoomBooking $booking)
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

        if (Carbon::parse($request->end_time)->lt(now())) {
            session()->flash('invalid_date', 'Tanggal booking sudah lewat dan tidak valid.');
            return back()->withInput();
        }
    
        $conflict = RoomBooking::where('room_id', $request->room_id)
            ->where('status', 'approved')
            ->where('id', '!=', $booking->id) 
            ->where(function($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                      ->orWhere(function($q) use ($request) {
                          $q->where('start_time', '<=', $request->start_time)
                            ->where('end_time', '>=', $request->end_time);
                      });
            })
            ->exists();
    
            if ($conflict && $request->status === 'approved') {
                if ($request->ajax()) {
                    return response()->json([
                        'conflict' => true,
                        'message' => 'Ruangan sudah dibooking pada waktu tersebut.'
                    ]);
                }
            
                return back()
                    ->withErrors(['start_time' => 'Ruangan sudah dibooking pada waktu tersebut.'])
                    ->withInput();
            }
    
        $booking->update([
            'room_id' => $request->room_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'jml_peserta' => $request->jml_peserta,
            'catatan' => $request->catatan,
            'reason' => $request->reason,
            'status' => $request->status, 
        ]);
    
        return redirect()->route('bookings.index')->with('success', 'Peminjaman berhasil diperbarui.');
    }

    // Tombol Approve
    public function approve($id)
    {
        $booking = RoomBooking::findOrFail($id);
    
        // Cek apakah ada booking lain yang bentrok dan sudah approved
        $conflict = RoomBooking::where('room_id', $booking->room_id)
            ->where('status', 'approved')
            ->where(function ($query) use ($booking) {
                $query->whereBetween('start_time', [$booking->start_time, $booking->end_time])
                    ->orWhereBetween('end_time', [$booking->start_time, $booking->end_time])
                    ->orWhere(function ($q) use ($booking) {
                        $q->where('start_time', '<', $booking->start_time)
                          ->where('end_time', '>', $booking->end_time);
                    });
            })->first();
    
        if ($conflict) {
            // Kirim data konflik ke tampilan SweetAlert
            return response()->json([
                'conflict' => true,
                'user_email' => $conflict->user->email,
                'start_time' => $conflict->start_time,
                'end_time' => $conflict->end_time,
            ]);
        }
    
        // Kalau tidak bentrok, set status approved
        $booking->status = 'approved';
        $booking->save();
    
        return response()->json(['success' => true]);
    }

    // Tombol Reject
    public function reject($id)
    {
        $booking = RoomBooking::findOrFail($id);
        $booking->status = 'rejected';
        $booking->save();
    
        return response()->json(['success' => true, 'message' => 'Booking berhasil ditolak.']);
    }

    // Batalkan booking
    public function cancel(RoomBooking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.myBookings')->with('success', 'Booking dibatalkan.');
    }

    // Hapus booking
    public function destroy(RoomBooking $booking)
    {
        $booking->delete();
        return response()->json(['success' => true, 'message' => 'Booking berhasil dihapus.']);
    }
}
