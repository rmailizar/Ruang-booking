@extends('layouts.app')

@section('content')
    
<h2 style="margin-left: 30px">Pinjam Ruangan</h2>

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
                    <tr>
                        <th>Nama Ruangan</th>
                        <th>Lokasi</th>
                        <th>Kapasitas</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{-- <td><label class="badge badge-info">Fixed</label></td> --}}
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
        </div>
      </div>


@endsection
