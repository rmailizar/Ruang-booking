@extends('layouts.app')

@section('content')
<h2>Edit User</h2>
<form action="{{ route('admin.users.update', $user->id) }}" method="POST">
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
</form>
@endsection
