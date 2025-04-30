@extends('layouts.app')

@section('title', 'booking')

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="content-wrapper">
    {{-- Card Total --}}
    <div class="container py-4">
        <div class="row mb-4">
            <!-- Total Ruangan -->
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-primary shadow">
                    <div class="card-body">
                        <h5 class="card-title text-white">Total Ruangan</h5>
                        <h2></h2>
                        <p>Total ruangan yang dimiliki</p>
                        <p class="fw-semibold fs-3">{{ $totalRooms }}</p>
                    </div>
                </div>
            </div>
            <!-- Total Peminjaman -->
            <div class="col-md-4 mb-4">
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
    {{-- End Card Total --}}
    
    {{-- Download Laporan --}}
    <h3 class="fw-bold">Download Laporan</h3> <hr>
    <form action="{{ route('bookings.export') }}" method="GET" class="mb-3">
        <div class="row g-2 align-items-end">
            <div class="col">
                <label for="export_start_date" class="form-label fs-6 badge text-bg-primary rounded fw-bold text-white">Dari Tanggal:</label>
                <input type="date" name="start_date" id="export_start_date" class="form-control" placeholder="Dari Tanggal">
            </div>
            <div class="col">
                <label for="export_end_date" class="form-label fs-6 badge text-bg-primary rounded fw-bold text-white">Sampai Tanggal:</label>
                <input type="date" name="end_date" id="export_end_date" class="form-control" placeholder="Sampai Tanggal">
            </div>
            <div class="col">
                <label for="status" class="form-label fs-6 badge text-bg-primary rounded fw-bold text-white">Status:</label>
                <select name="status" id="status" class="form-select">
                    <option value="">-- Semua Status --</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-success fw-bold" type="submit">
                    Download Excel
                </button>
                <button class="btn btn-danger fw-bold" type="button" onclick="resetFilterExport()">
                    Reset
                </button>
            </div>
        </div>
    </form> <hr>
    {{-- end Download Laporan --}}    

    {{-- Tabel Booking --}}
    <h2 class="fw-bold">Daftar Peminjaman</h2>

    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Table Peminjaman</h4>

            {{-- Search dan Filter --}}
            <form action="{{ route('bookings.index') }}" method="GET" class="row g-2 align-items-end mb-3">
                <div class="col-md-3">
                    <label for="search" class="form-label fw-bold badge rounded text-bg-primary">Cari Nama/NIM/Ruangan:</label>
                    <input type="text" name="search" id="search" class="form-control"
                        value="{{ request('search') }}" placeholder="Nama/NIM/Ruangan">
                </div>
                <div class="col-md-2">
                    <label for="start_date" class="form-label badge rounded fw-bold text-bg-primary">Dari Tanggal:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ request('start_date') }}">
                </div>
                <div class="col-md-2">
                    <label for="end_date" class="form-label badge rounded fw-bold text-bg-primary">Sampai Tanggal:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                        value="{{ request('end_date') }}">
                </div>
                <div class="col-md-2">
                    <label for="status" class="form-label fw-bold badge rounded text-bg-primary">Pilih Status:</label>
                    <select name="status" id="status" class="form-select form-control">
                        <option value="">-- Semua Status --</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-success fw-bold">Terapkan</button>
                    <a href="{{ route('bookings.index') }}" class="btn btn-danger fw-bold">Reset</a>
                </div>
            </form>
            {{-- End Search dan Filter --}}

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr  class="text-center">
                            <th>No</th>
                            <th>Peminjam</th>
                            <th>No HP</th>
                            <th>Jurusan</th>
                            <th>Ruangan</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Waktu</th>
                            <th>Acara/Kegiatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $index => $booking)
                            <tr  class="text-center">
                                <td>{{ $bookings->firstItem() + $index  }}</td>
                                <td class="lh-base">{{ $booking->user->name }} <br> <span class="text-sm fw-light">{{ $booking->user->nim }}</span> </td>
                                <td>{{ $booking->user->no_hp }}</td>
                                <td>{{ $booking->user->jurusan }}</td>
                                <td>{{ $booking->room->name }}</td>
                                <td>{{ $booking->room->location }}</td>
                                <td>
                                    <span class="badge bg-{{ $booking->status == 'approved' ? 'success' : ($booking->status == 'rejected' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                                <td>{{ $booking->reason }}</td>
                                <td>
                                    @if($booking->status === 'pending')
                                        {{-- Button Approve --}}
                                        <form id="approve-form-{{ $booking->id }}" style="display:inline;">                       
                                            <button type="button" class="fw-bold btn text-white rounded bg-success btn-sm btn-approve"
                                            data-id="{{ $booking->id }}">Approve</button> |
                                        </form>
                                        {{-- Button Reject --}}
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="button"
                                        class="fw-bold btn rounded btn-danger btn-sm btn-reject"
                                        data-id="{{ $booking->id }}">
                                        Reject
                                        </button>                                       
                                    @endif
                                    @if($booking->status === 'approved' || $booking->status === 'rejected')
                                    {{-- Button Edit --}}
                                    <a href="{{ route('bookings.edit', $booking->id) }}" class="btn rounded btn-sm btn-warning text-decoration-none">Edit</a> |
                                    {{-- Button Hapus --}}
                                    <button type="button" class="fw-bold btn rounded btn-sm btn-danger btn-delete-booking" data-id="{{ $booking->id }}">
                                        Hapus
                                    </button>
                                    @endif                
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3">
                {{ $bookings->links('pagination::bootstrap-4') }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- End Table Booking --}}

  {{--  --}}
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        $('.btn-approve').click(function () {
            const bookingId = $(this).data('id');
            fetch(`/admin/bookings/${bookingId}/approve`)
                .then(res => res.json())
                .then(data => {
                    if (data.conflict) {
                        Swal.fire({
                            title: "Ruangan sudah dibooking!",
                            html: `Ruangan ini sudah dibooking oleh <br> <b>${data.user_email}</b><br>Dari:<br> <b>${data.start_time}</b> <br> Sampai: <br> <b>${data.end_time}</b>`,
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "Reject",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Kirim reject
                                fetch(`/admin/bookings/${bookingId}/reject`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Accept': 'application/json'
                                    }
                                }).then(res => res.json()).then(() => {
                                    Swal.fire("Ditolak!", "", "success").then(() => location.reload());
                                });
                            }
                        });
                    } else {
                        Swal.fire("Berhasil disetujui!", "", "success").then(() => location.reload());
                    }
                });
        });

        // Button Reject
        $('.btn-reject').click(function () {
        const bookingId = $(this).data('id');

            Swal.fire({
                title: "Tolak Booking?",
                text: "Apakah Anda yakin ingin menolak booking ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Tolak",
                cancelButtonText: "Batal",
                confirmButtonColor: "#d33"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/bookings/${bookingId}/reject`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        Swal.fire("Ditolak!", data.message, "success").then(() => location.reload());
                    });
                }
            });
        });

        // Button Hapus
        $('.btn-delete-booking').click(function () {
        const bookingId = $(this).data('id');

            Swal.fire({
                title: "Hapus Booking?",
                text: "Data peminjaman ini akan dihapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Hapus",
                cancelButtonText: "Batal",
                confirmButtonColor: "#d33"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/bookings/${bookingId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        Swal.fire("Berhasil!", data.message, "success").then(() => location.reload());
                    });
                }
            });
        });
    });

    </script>
    
    {{-- Kosongkan input --}}
   <script>
    function resetFilterExport() {
        document.getElementById('export_start_date').value = '';
        document.getElementById('export_end_date').value = '';
        document.getElementById('status').value = '';
    }
   </script> 
@endsection
