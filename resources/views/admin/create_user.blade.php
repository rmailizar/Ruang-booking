@extends('layouts.app')

@section('content')
<h2>Tambah User</h2>
{{-- <form action="{{ route('admin.users.store') }}" method="POST">
    @csrf
    <div class="form-group"><label>Nama</label><input name="name" class="form-control"></div>
    <div class="form-group"><label>Email</label><input name="email" class="form-control" type="email"></div>
    <div class="form-group"><label>Password</label><input name="password" class="form-control" type="password"></div>
    <div class="form-group"><label>Role</label>
        <select name="role" class="form-control">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <div class="form-group"><label>No HP</label><input name="no_hp" class="form-control"></div>
    <div class="form-group"><label>NIM</label><input name="nim" class="form-control"></div>
    <div class="form-group"><label>Jurusan</label><input name="jurusan" class="form-control"></div>
    <button type="submit" class="btn btn-success mt-2">Simpan</button>
</form> --}}

<div class="content-wrapper">
    <div class="row">
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Formulir Data Ruangan</h4>
            <form class="forms-sample" action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Nama" required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input name="email" class="form-control" type="email" id="lokasi" placeholder="Email@untirta.ac.id" required>
              </div>
              <div class="form-group">
                <label for="no_hp">No_hp</label>
                <input name="no_hp" class="form-control" type="number" id="no_hp" placeholder="No Hp" required>
              </div>
              <div class="form-group">
                <label for="nim">NIM/NIPD</label>
                <input name="nim" class="form-control" type="number" id="nim" placeholder="NIM/NIPD" required>
              </div>
              <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <input name="jurusan" class="form-control" type="text" id="nim" placeholder="Jurusan" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input name="password" class="form-control" type="password" id="password" placeholder="Password" required>
              </div>
              <div class="form-group">
                <label for="image" class="form-label">Upload Foto</label>
                <input class="form-control" type="file" id="image" name="image">
              </div>
              <div class="form-group">
                <label for="role">Role</label>
                <select name="role" class="form-control" id="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
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
