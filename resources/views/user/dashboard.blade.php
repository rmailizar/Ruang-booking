@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Dashboard User</h4>
        </div>
        <div class="card-body">
            <p>Hai, <strong>{{ Auth::user()->name }}</strong>!</p>
            <p>Selamat datang di halaman user.</p>
        </div>
    </div>
@endsection
