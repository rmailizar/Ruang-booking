@extends('layouts.app')

@section('content')
    <h2>Tambah Ruangan</h2>

    <div class="content-wrapper">
        <div class="row">
          <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Formulir Data Ruangan</h4>
                <form class="forms-sample" action="{{ route('rooms.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                    <label for="namaRuangan">Nama Ruangan</label>
                    <input type="text" class="form-control" name="name" id="namaRuangan" placeholder="Room name" required>
                  </div>
                  <div class="form-group">
                    <label for="lokasi">Lokasi</label>
                    <input type="text" class="form-control" name="location" id="lokasi" placeholder="Location" required>
                  </div>
                  <div class="form-group">
                    <label for="kapasitas">Kapasitas</label>
                    <input type="number" class="form-control" name="capacity" id="kapasitas" placeholder="Capacity" required>
                  </div>
                  <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="description" class="form-control" id="deskripsi" placeholder="Description"></textarea><br>
                  </div>
                  <button type="submit" class="btn btn-primary me-2">Submit</button>
                  <button class="btn btn-light">Cancel</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
