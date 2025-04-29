@extends('layouts.app')

@section('title', 'RoomDetail') 

@section('content')

  <div class="content-wrapper"> 

    <div class="row">

        <div class="col-lg-6">
            <div class="card p-4">
                @if ($room->image)
                <img src="{{ asset('storage/' . $room->image) }}" 
                    class="card-img-top" 
                    alt="{{ $room->name }}" 
                    style="object-fit: cover; height: 200px; width: 100%; max-height: 200px; margin-bottom: 15px;">
                @else
                    <div class="bg-warning text-white d-flex align-items-center justify-content-center" 
                        style="height: 200px; width: 100%; max-height: 200px; font-size: 36px; margin-bottom: 15px;">
                        {{ $room->name }}
                    </div>
                @endif
                <h5 class="fw-bold">Detail Ruangan</h5>
                <hr>
                <ul class="list-unstyled">
                    <li class="mb-2 fs-6">
                      <i class="menu-icon mdi mdi-city text-primary"></i>
                      <strong>Nama Ruangan:</strong> {{ $room->name }}
                    </li>
                    <li class="mb-2 fs-6">
                      <i class="menu-icon mdi mdi-google-maps text-primary"></i>
                      <strong>Lokasi:</strong> {{ $room->location }}
                    </li>
                    <li class="mb-2 fs-6">
                      <i class="menu-icon mdi mdi-account-multiple text-primary"></i>
                      <strong>Kapasitas:</strong> {{ $room->capacity ?? '-' }}
                    </li>
                    <li class="mb-2 fs-6">
                        <i class="menu-icon mdi mdi-calendar-text text-primary"></i>
                        <strong>Deskripsi:</strong> {{ $room->description ?? '-' }}
                      </li>
                </ul>
            </div>
        </div>

        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">Jadwal Peminjaman Ruangan: {{ $room->name }}</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Acara/Kegiatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookings as $index => $booking)
                                <tr class="text-center">
                                    <td>{{ $bookings->firstItem() + $index }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->start_time)->format('d/m/Y H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->end_time)->format('d/m/Y H:i') }}</td>
                                    <td>{{ $booking->reason ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada peminjaman untuk ruangan ini.</td>
                                </tr>
                            @endforelse
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
@endsection
