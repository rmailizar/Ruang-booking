@extends('layouts.app')

@section('title', 'index') 

@section('content')
<h2 style="margin-left: 30px">Dashboard</h2>

<div class="container py-4">
    <div class="row mb-4">
        <!-- Total Ruangan -->
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-primary shadow">
                <div class="card-body">
                    <h5 class="card-title text-white">Total Ruangan</h5>
                    <h2></h2>
                    <p>Total ruangan yang dimiliki</p>
                    <p class="fw-semibold fs-3">{{ $totalRooms }}</p>
                </div>
            </div>
        </div>
        <!-- Total Pengguna -->
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-info shadow">
                <div class="card-body">
                    <h5 class="card-title text-white">Total Pengguna</h5>
                    <h2></h2>
                    <p>Total pengguna saat ini</p>
                    <p class="fw-semibold fs-3">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <!-- Total Peminjaman -->
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-danger shadow">
                <div class="card-body">
                    <h5 class="card-title text-white">Total Peminjaman</h5>
                    <h2></h2>
                    <p>Total peminjaman dari awal</p>
                    <p class="fw-semibold fs-3">{{ $totalBookings }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
