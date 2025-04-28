@extends('layouts.app')

@section('content')
    
<h2 style="margin-left: 30px">Pinjam Ruangan</h2>

    <div class="content-wrapper">
        {{-- <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Table Ruangan</h4>
                </p>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Nama Ruangan</th>
                        <th>Lokasi</th>
                        <th>Kapasitas</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($rooms as $index => $room)
                    <tr>
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->location }}</td>
                        <td>{{ $room->capacity }}</td>
                        <td>{{ $room->description }}</td>
                        <td>
                            <a href="{{ route('bookings.create', ['room_id' => $room->id]) }}" class="btn fw-semibold rounded btn-sm btn-primary">Pinjam</a>
                        </td>
                    </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div> --}}


        
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
                              <div class="bg-warning text-white d-flex align-items-center justify-content-center" 
                                  style="height: 200px; width: 100%; max-height: 200px; font-size: 36px;">
                                  {{ $room->name }}
                              </div>
                          @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $room->name }}</h5>

                                <p class="card-text mb-1">
                                    <strong>Lokasi:</strong> {{ $room->location }}
                                </p>

                                <p class="card-text mb-3">
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
