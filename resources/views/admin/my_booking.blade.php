@extends('layouts.app')

@section('title', 'Peminjaman Saya')

@section('content')
<div class="container">
    <h4 class="mb-3">Peminjaman Saya</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Jumlah Peserta</th>
                <th>Status</th>
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
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada peminjaman</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
