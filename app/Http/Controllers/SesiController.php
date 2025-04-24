<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index(){
        return view('auth.login');
    }

    function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'email wajib diisi',
            'password.required' => 'password wajib diisi',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($infologin)){
            if(Auth::user()->role == 'admin'){
                return redirect('admin');
            } elseif(Auth::user()-> role == 'user'){
                return redirect('user');
            }
        } else{
            return redirect('')->withErrors('Email atau Password tidak valid')->withInput();
        }
    }

    function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
