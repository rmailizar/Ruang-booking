<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'no_hp'    => 'required',
            'nim'      => 'nullable',
            'jurusan'  => 'nullable',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'no_hp'    => $request->no_hp,
            'nim'      => $request->nim,
            'jurusan'  => $request->jurusan,
        ]);

        return redirect('/')->with('success', 'Register berhasil.');
    }
}
