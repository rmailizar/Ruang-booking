@extends('layouts.app')

@section('title', 'Peminjaman Saya')

@section('content')
<div class="container">
    <h4 class="mb-3">Peminjaman Saya</h4>

    <h2 style="margin-left: 30px">Daftar Ruangan</h2>
    <div class="content-wrapper">
        <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Table Ruangan</h4>
                </p>
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
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $index => $booking)
                            <tr class="text-center">
                                <td>{{ $index + 1 }}</td>
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
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada peminjaman</td>
                            </tr>
                        @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    {{-- <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Jumlah Peserta</th>
                <th>Status</th>
                <th>Acara/Kegiatan</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bookings as $index => $booking)
                <tr>
                    <td>{{ $index + 1 }}</td>
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
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada peminjaman</td>
                </tr>
            @endforelse
        </tbody>
    </table> --}}
</div>
@endsection
