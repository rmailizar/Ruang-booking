@extends('layouts.app')

@section('content')
<h2>Edit User</h2>
{{-- <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
    @csrf @method('PUT')
    <div class="form-group"><label>Nama</label><input name="name" class="form-control" value="{{ $user->name }}"></div>
    <div class="form-group"><label>Email</label><input name="email" class="form-control" value="{{ $user->email }}"></div>
    <div class="form-group"><label>Password (Kosongkan jika tidak diubah)</label><input name="password" class="form-control" type="password"></div>
    <div class="form-group"><label>Role</label>
        <select name="role" class="form-control">
            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
    </div>
    <div class="form-group"><label>No HP</label><input name="no_hp" class="form-control" value="{{ $user->no_hp }}"></div>
    <div class="form-group"><label>NIM</label><input name="nim" class="form-control" value="{{ $user->nim }}"></div>
    <div class="form-group"><label>Jurusan</label><input name="jurusan" class="form-control" value="{{ $user->jurusan }}"></div>
    <button type="submit" class="btn btn-primary mt-2">Update</button>
</form> --}}

<div class="content-wrapper">
    <h2>Edit User</h2>
    <div class="row">
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Formulir Data User</h4>
            <form class="forms-sample" action="{{ route('admin.users.update', $user->id) }}" method="POST">
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
                <input type="text" class="form-control" name="password" id="password" placeholder="Password" required>
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
              <button class="btn btn-light">Cancel</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
