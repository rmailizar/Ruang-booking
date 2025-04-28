@extends('layouts.app')

@section('title', 'Room') 

@section('content')
  {{-- Card Total --}}
  <div class="content-wrapper">
    <div class="container py-4">
      <div class="row mb-4">
          <!-- Total Ruangan -->
          <div class="col-md-4 mb-4">
              <div class="card text-white bg-primary shadow">
                  <div class="card-body">
                      <h5 class="card-title text-white">Total Ruangan</h5>
                      <p class="card-text">Total ruangan yang dimiliki</p>
                      <p class="fw-semibold fs-3">{{ $totalRooms }}</p>
                  </div>
              </div>
          </div>
      </div>
  {{-- End Card Total --}}
      
  {{-- Tabel Ruangan --}}
  <h2>Daftar Ruangan</h2>
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
                    <th>Nama</th>
                    <th>Lokasi</th>
                    <th>Kapasitas</th>
                    <th>Deskripsi</th> 
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                {{-- <td><label class="badge badge-info">Fixed</label></td> --}}
                <a href="{{ route('rooms.create') }}" class="text-decoration-none fw-bold btn btn-sm rounded bg-info fs-6 mb-2 text-white">+ Tambah Ruangan</a>
                  @foreach ($rooms as $index => $room)
                      <tr class="text-center">                
                          <td>{{ $rooms->firstItem() + $index }}</td>
                          <td>{{ $room->name }}</td>
                          <td>{{ $room->location }}</td>
                          <td>{{ $room->capacity }}</td>
                          <td>{{ $room->description }}</td> 
                          <td>
                            <a href="{{ route('rooms.edit', $room) }}" class="btn rounded btn-sm btn-warning text-decoration-none">Edit</a> | 
                            <form action="{{ route('rooms.destroy', $room) }}" method="POST" style="display:inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Delete?')" class="btn rounded btn-sm btn-danger">Hapus</button>
                            </form>
                          </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="d-flex justify-content-end mt-3">
              {{ $rooms->links('pagination::bootstrap-4') }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- End Table Ruangan --}}
@endsection
