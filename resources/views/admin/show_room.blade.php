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
  <h2 class="fw-bold">Daftar Ruangan</h2>
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Table Ruangan</h4>
            {{-- Search dan Filter --}}
            <form action="{{ route('rooms.index') }}" method="GET" class="row g-2 align-items-end mb-3">
              <div class="col-md-3">
                <label for="search" class="form-label fw-bold badge rounded text-bg-primary">Cari Ruangan</label>
                <input type="text" name="search" id="search" class="form-control"
                    value="{{ request('search') }}" placeholder="Nama/Lokasi/Deskripsi">
              </div>
              <div class="col-md-2">
                <label for="capacity_min" class="form-label badge rounded fw-bold text-bg-primary">Dari angka:</label>
                <input type="number" id="capacity_min" name="capacity_min" placeholder="Kapasitas" class="form-control" value="{{ request('capacity_min') }}">
              </div>
              <div class="col-md-2">
                <label for="capacity_max" class="form-label badge rounded fw-bold text-bg-primary">Sampai angka:</label>
                <input type="number" id="capacity_max" name="capacity_max" placeholder="Kapasitas" class="form-control" value="{{ request('capacity_max') }}">
              </div>
              <div class="col-md-3 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-success fw-bold">Terapkan</button>
                <a href="{{ route('rooms.index') }}" class="btn btn-danger fw-bold">Reset</a>
              </div>
            </form>
            {{-- End Search dan Filter --}}
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th class="text-start">Foto</th>
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
                          <td class="text-start">
                            @if($room->image)
                                <img src="{{ asset('storage/'.$room->image) }}" alt="Foto User" width="60" height="70" class="rounded-circle">
                            @else
                                <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width:40px; height:40px; font-size:15px;">
                                    {{ strtoupper(substr($room->name, 0, 2)) }}
                                </div>
                            @endif
                          </td>
                          <td>{{ $room->name }}</td>
                          <td>{{ $room->location }}</td>
                          <td>{{ $room->capacity }}</td>
                          <td>{{ $room->description }}</td> 
                          <td>
                            <a href="{{ route('rooms.detail', $room->id) }}" class="btn btn-secondary btn-sm rounded fw-bold">Detail</a> |
                            <a href="{{ route('rooms.edit', $room) }}" class="btn rounded btn-sm btn-warning text-decoration-none">Edit</a> | 
                            <form id="delete-room-form-{{ $room->id }}" action="{{ route('rooms.destroy', $room) }}" method="POST" style="display:inline">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-delete-room rounded btn-sm btn-danger" data-id="{{ $room->id }}" data-nama="{{ $room->name }}">Hapus</button>
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

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-delete-room').forEach(button => {
            button.addEventListener('click', function () {
                const roomId = this.dataset.id;
                const roomName = this.dataset.nama;

                Swal.fire({
                    title: `Hapus Ruangan ${roomName}?`,
                    text: "Data Ruangan akan dihapus secara permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, Hapus",
                    cancelButtonText: "Batal",
                    confirmButtonColor: "#d33"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-room-form-${roomId}`).submit();
                    }
                });
            });
        });
    });
</script>
@endsection
