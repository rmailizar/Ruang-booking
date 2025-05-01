<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomBooking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserDBController extends Controller
{
    public function index(Request $request)
    {
        $totalRooms = Room::count();
        $totalUsers = User::count();
        $totalBookings = RoomBooking::count();

        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('nim', 'like', "%$search%")
                ->orWhere('no_hp', 'like', "%$search%")
                ->orWhere('jurusan', 'like', "%$search%");
            });
        }

        $users = $query->paginate(10)->appends($request->all());

        return view('admin.show_user', compact('users', 'totalRooms', 'totalUsers', 'totalBookings'));
    }

    public function create()
    {
        return view('admin.create_user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role'     => 'required|in:user,admin',
            'no_hp'    => 'required',
            'nim'      => 'nullable',
            'jurusan'  => 'nullable',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ], [
            'email.unique' => 'Email sudah terdaftar, silahkan gunakan email lain.',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('user_images', 'public');
        } else {
            $imagePath = null;
        }

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'no_hp'    => $request->no_hp,
            'nim'      => $request->nim,
            'jurusan'  => $request->jurusan,
            'image'    => $imagePath,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.edit_user', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email|unique:users,email,' . $user->id,
            'role'    => 'required|in:user,admin',
            'no_hp'   => 'required',
            'nim'     => 'nullable',
            'jurusan' => 'nullable',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if (auth()->id() === $user->id && $request->role !== $user->role) {
            return redirect()->back()->with('error', 'Anda tidak dapat mengubah role akun Anda sendiri.');
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('user_images', 'public');
            $user->image = $imagePath; // update image jika ada file baru
        }

        $user->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'role'    => $request->role,
            'no_hp'   => $request->no_hp,
            'nim'     => $request->nim,
            'jurusan' => $request->jurusan,
        ]);

        if ($request->password) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate.');
    }

    public function editProfile(User $user)
    {
        $user = Auth::user();
        return view('edit_biodata', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'email'   => 'required|email|unique:users,email,' . $user->id,
            'no_hp'   => 'required',
            'password'=> 'nullable|min:6',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('user_images', 'public');
            $user->image = $imagePath;
        }

        $user->email = $request->email;
        $user->no_hp = $request->no_hp;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('biodata')->with('success', 'Profil berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }
        
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}
