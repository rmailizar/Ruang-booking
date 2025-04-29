@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
      <h2 class="fw-bold">Pinjam Ruangan</h2>
          <div class="container mt-4">
            <div class="row">
                @foreach($rooms as $room)
                    <div class="col-6 col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                          @if ($room->image)
                          <img src="{{ asset('storage/' . $room->image) }}" 
                               class="card-img-top" 
                               alt="{{ $room->name }}" 
                               style="object-fit: cover; height: 200px; width: 100%; max-height: 200px;">
                          @else
                              <div class="bg-warning  card-img-top text-white d-flex align-items-center justify-content-center" 
                                  style="height: 200px; width: 100%; max-height: 200px; font-size: 36px;">
                                  {{ $room->name }}
                              </div>
                          @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $room->name }}</h5>

                                <p class="card-text mb-1">
                                  <i class="menu-icon mdi mdi-google-maps text-primary"></i>
                                  <strong>Lokasi:</strong> {{ $room->location }}
                                </p>

                                <p class="card-text mb-3">
                                  <i class="menu-icon mdi mdi-account-multiple text-primary"></i>
                                  <strong>Kapasitas:</strong> {{ $room->capacity }} orang
                                </p>
      
                                <a href="{{ route('rooms.detail', $room->id) }}" class="btn btn-secondary btn-sm rounded mb-2 fw-bold">Detail</a>
                                <a href="{{ route('bookings.create', ['room_id' => $room->id]) }}" class="btn btn-primary btn-sm rounded fw-bold">Pinjam</a>                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
      </div>


@endsection
