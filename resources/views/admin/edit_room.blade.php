@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <h2 class="fw-bold">Edit Ruangan</h2>
        <div class="row">
          <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Formulir Data Ruangan</h4>
                <form class="forms-sample" action="{{ route('rooms.update', $room) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="form-group">
                    <label for="namaRuangan">Nama Ruangan<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" id="namaRuangan" placeholder="Room name" value="{{ $room->name }}" required>
                  </div>
                  <div class="form-group">
                    <label for="lokasi">Lokasi<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="location" id="lokasi" placeholder="Location" value="{{ $room->location }}" required>
                  </div>
                  <div class="form-group">
                    <label for="kapasitas">Kapasitas<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="capacity" id="kapasitas" placeholder="Capacity" value="{{ $room->capacity }}" required>
                  </div>
                  <div class="form-group">
                    <label for="image" class="form-label">Upload Foto (Kosongkan jika tidak diubah)</label>
                    <input class="form-control" type="file" id="image" name="image">
                  </div>
                  <div class="form-group">
                    <label for="deskripsi">Deskripsi (Opsional)</label>
                    <textarea name="description" class="form-control" id="deskripsi" placeholder="Description">{{ $room->description }}</textarea><br>
                  </div>
                  <button type="submit" class="btn btn-primary me-2">Update</button>
                  <a class="btn btn-light" href="{{ route('rooms.index') }}">Cancel</a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      
@endsection
