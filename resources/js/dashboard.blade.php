@extends('layouts.app')

@section('title', 'index') 

@section('content')
<h2 style="margin-left: 30px">Dashboard</h2>

<div class="container py-4">
    <!-- Scrollable Row -->
    <div class="d-flex flex-nowrap overflow-auto mb-4" style="gap: 1rem;">
        <!-- Total Ruangan -->
        <div class="card text-white bg-primary shadow" style="min-width: 250px;">
            <div class="card-body">
                <h5 class="card-title text-white">Total Ruangan</h5>
                <p>Total ruangan yang dimiliki</p>
                <p class="fw-semibold fs-3">{{ $totalRooms }}</p>
            </div>
        </div>

        <!-- Total Pengguna -->
        <div class="card text-white bg-info shadow" style="min-width: 250px;">
            <div class="card-body">
                <h5 class="card-title text-white">Total Pengguna</h5>
                <p>Total pengguna saat ini</p>
                <p class="fw-semibold fs-3">{{ $totalUsers }}</p>
            </div>
        </div>

        <!-- Total Peminjaman -->
        <div class="card text-white bg-danger shadow" style="min-width: 250px;">
            <div class="card-body">
                <h5 class="card-title text-white">Total Peminjaman</h5>
                <p>Total peminjaman dari awal</p>
                <p class="fw-semibold fs-3">{{ $totalBookings }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
