<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Room;
use App\Models\RoomBooking;

class AdminController extends Controller
{
    public function index()
    {
    
    $totalRooms = Room::count();
    $totalUsers = User::count();
    $totalBookings = RoomBooking::count();

    return view('admin.dashboard', compact('totalRooms', 'totalUsers', 'totalBookings'));
    }
}
