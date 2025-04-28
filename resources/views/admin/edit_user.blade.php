@extends('layouts.app')

@section('content')
<h2>Edit User</h2>

<div class="content-wrapper">
    <h2>Edit User</h2>
    <div class="row">
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Formulir Data User</h4>
            <form class="forms-sample" action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control" id="name" placeholder="Nama" value="{{ $user->name }}" name="name" class="form-control" value="{{ $user->name }}" required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{ $user->email }}" required>
              </div>
              <div class="form-group">
                <label for="password">Password (Kosongkan jika tidak diubah)</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
              </div>
              <div class="form-group">
                <label for="image" class="form-label">Upload Foto</label>
                <input class="form-control" type="file" id="image" name="image">
              </div>
              <div class="form-group">
                <label for="role">Role</label>
                <select name="role" class="form-control">
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
              </div>
              <div class="form-group">
                <label for="no_hp">No. HP</label>
                <input type="number" class="form-control" name="no_hp" id="no_hp" placeholder="No. HP" value="{{ $user->no_hp }}" required>
              </div>
              <div class="form-group">
                <label for="nim">NIM</label>
                <input type="number" class="form-control" name="nim" id="nim" placeholder="NIM" value="{{ $user->nim }}" required>
              </div>
              <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <input type="text" class="form-control" name="jurusan" id="jurusan" placeholder="Jurusan" value="{{ $user->jurusan }}" required>
              </div>
              <button type="submit" class="btn btn-primary me-2">Submit</button>
              <a class="btn btn-light" href="{{ route('admin.users.index') }}">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
