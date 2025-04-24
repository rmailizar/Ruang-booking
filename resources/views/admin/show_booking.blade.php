@extends('layouts.app')

@section('title', 'booking')

@section('content')
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

    <form action="{{ route('bookings.export') }}" method="GET" class="mb-3">
        <div class="row g-2 align-items-end">
            <div class="col">
                <label for="start_date" class="form-label">Dari Tanggal</label>
                <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Dari Tanggal">
            </div>
            <div class="col">
                <label for="end_date" class="form-label">Sampai Tanggal</label>
                <input type="date" name="end_date" id="end_date" class="form-control" placeholder="Sampai Tanggal">
            </div>
            <div class="col-auto">
                <button class="btn btn-success" type="submit">
                    Download Excel
                </button>
                <button class="btn btn-secondary" type="button" onclick="resetDateFilter()">
                    Cancel
                </button>
            </div>
        </div>
    </form>
    
    <script>
        function resetDateFilter() {
            document.getElementById('start_date').value = '';
            document.getElementById('end_date').value = '';
        }
    </script>
    
<h2 style="margin-left: 30px">Daftar Booking</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Table Booking</h4>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr  class="text-center">
                            <th>No</th>
                            <th>Peminjam</th>
                            <th>Jurusan</th>
                            <th>Ruangan</th>
                            <th>Lokasi</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $index => $booking)
                            <tr  class="text-center">
                                <td>{{ $index + 1 }}</td>
                                <td class="lh-base">{{ $booking->user->name }} <br> <span class="text-sm fw-light">{{ $booking->user->nim }}</span> </td>
                                <td>{{ $booking->user->jurusan }}</td>
                                <td>{{ $booking->room->name }}</td>
                                <td>{{ $booking->room->location }}</td>
                                <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                                <td>{{ $booking->status }}</td>
                                <td>
                                    @if($booking->status === 'pending')
                                        <form action="{{ route('bookings.updateStatus', $booking->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="approved">
                                            <button class="btn rounded btn-primary btn-sm" type="submit">Approve</button>
                                        </form>
                                        <form action="{{ route('bookings.updateStatus', $booking->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="rejected">
                                            <button class="btn rounded btn-warning btn-sm" type="submit">Reject</button>
                                        </form>
                        
                                    @endif
                                    <form action="{{ route('bookings.destroy', $booking) }}" method="POST" style="display:inline">
                                        @csrf 
                                        @method('DELETE')
                                        <button onclick="return confirm('Delete?')" class="btn rounded btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
