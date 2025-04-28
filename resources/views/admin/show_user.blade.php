@extends('layouts.app')

@section('title', 'User')

@section('content')

<div class="content-wrapper">
    <div class="container py-2">
        <div class="row mb-4">
            <!-- Total Pengguna -->
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-info shadow">
                    <div class="card-body">
                        <h5 class="card-title text-white">Total Pengguna</h5>
                        <h2></h2>
                        <p>Total pengguna saat ini</p>
                        <p class="fw-semibold fs-3">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>   

    <h2>Daftar Pengguna</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Table Pengguna</h4>
            </p>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. HP</th>
                            <th>Role</th>
                            <th>NIM</th>
                            <th>Jurusan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <a href="{{ route('admin.users.create') }}" class="text-decoration-none text-white rounded fw-bold btn btn-sm bg-info fs-6 mb-2">+ Tambah User</a>
                        @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $index }}</td>
                            <td>
                                @if($user->image)
                                    <img src="{{ asset('storage/'.$user->image) }}" alt="Foto User" width="50" height="60" class="rounded-circle">
                                @else
                                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width:40px; height:40px; font-size:15px;">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                @endif
                            </td>
                            <td>{{ $user->name}}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->no_hp }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->nim }}</td>
                            <td>{{ $user->jurusan }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn rounded btn-sm btn-warning text-decoration-none">Edit</a> |
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline">
                                    @csrf @method('DELETE')
                                    <button class="btn rounded btn-sm btn-danger" onclick="return confirm('Hapus user ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3">
                {{ $users->links('pagination::bootstrap-4') }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
