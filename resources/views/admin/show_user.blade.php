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

    <h2 class="fw-bold">Daftar Pengguna</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Table Pengguna</h4>
            {{-- Search dan Filter --}}
            <form action="{{ route('admin.users.index') }}" method="GET" class="row g-2 align-items-end mb-3">
                <div class="col-md-3">
                  <label for="search" class="form-label fw-bold badge rounded text-bg-primary">Cari Pengguna</label>
                  <input type="text" name="search" id="search" class="form-control"
                      value="{{ request('search') }}" placeholder="Nama/email/nim etc.">
                </div>
                <div class="col-md-3 d-flex align-items-end gap-2">
                  <button type="submit" class="btn btn-success fw-bold">Terapkan</button>
                  <a href="{{ route('admin.users.index') }}" class="btn btn-danger fw-bold">Reset</a>
                </div>
            </form>
            {{-- End Search dan Filter --}}
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
                                
                                <form id="delete-user-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn rounded btn-sm btn-danger btn-delete-user"
                                            data-id="{{ $user->id }}" data-nama="{{ $user->name }}">Hapus</button>
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

  <script>
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: '{{ session('error') }}',
        });
    @endif

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
        });
    @endif
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-delete-user').forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.dataset.id;
                const userName = this.dataset.nama;

                Swal.fire({
                    title: `Hapus User ${userName}?`,
                    text: "Data user akan dihapus secara permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, Hapus",
                    cancelButtonText: "Batal",
                    confirmButtonColor: "#d33"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-user-form-${userId}`).submit();
                    }
                });
            });
        });
    });
</script>
@endsection
