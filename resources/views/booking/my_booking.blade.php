@extends('layouts.app')

@section('title', 'Peminjaman Saya')

@section('content')

<div class="content-wrapper">
    {{-- Tabel Booking --}}
    <h2 class="fw-bold">History Peminjaman</h2>
    
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Tabel History Peminjaman </h4>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Ruangan</th>
                            <th>Waktu Mulai</th>
                            <th>Waktu Selesai</th>
                            <th>Jumlah Peserta</th>
                            <th>Status</th>
                            <th>Acara/Kegiatan</th>
                            <th>Catatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $index => $booking)
                            <tr class="text-center">
                                <td>{{ $bookings->firstItem() + $index  }}</td>
                                <td>{{ $booking->room->name ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->start_time)->format('d/m/Y H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->end_time)->format('d/m/Y H:i') }}</td>
                                <td>{{ $booking->jml_peserta }}</td>
                                <td>
                                    <span class="badge bg-{{ $booking->status == 'approved' ? 'success' : ($booking->status == 'rejected' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td>{{ $booking->reason ?? '-' }}</td>
                                <td>{{ $booking->catatan ?? '-' }}</td>
                                <td>
                                    @if($booking->status === 'pending' || $booking->status === 'approved')
                                    <form action="{{ route('bookings.cancel', $booking) }}" method="POST" style="display:inline">
                                        @csrf 
                                        @method('DELETE')
                                        <button class="btn rounded btn-sm btn-danger">Batalkan</button>
                                    </form>
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


@endsection
