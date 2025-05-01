@extends('layouts.app')

@section('content')

<div class="content-wrapper">
  <h2 class="fw-bold">Tambah User</h2>
    <div class="row">
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Formulir Data User</h4>
            <form class="forms-sample" action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                <label for="name">Nama<span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Nama" required>
              </div>
              <div class="form-group">
                <label for="email">Email<span class="text-danger">*</span></label>
                <input name="email" class="form-control" type="email" id="lokasi" placeholder="Email@untirta.ac.id" required>
              </div>
              <div class="form-group">
                <label for="no_hp">No Hp<span class="text-danger">*</span></label>
                <input name="no_hp" class="form-control" type="number" id="no_hp" placeholder="No Hp" required>
              </div>
              <div class="form-group">
                <label for="nim">NIM/NIDN<span class="text-danger">*</span></label>
                <input name="nim" class="form-control" type="number" id="nim" placeholder="NIM/NIPD" required>
              </div>
              <div class="form-group">
                <label for="jurusan">Jurusan<span class="text-danger">*</span></label>
                <input name="jurusan" class="form-control" type="text" id="nim" placeholder="Jurusan" required>
              </div>
              <div class="form-group">
                <label for="password">Password<span class="text-danger">*</span></label>
                <input name="password" class="form-control" type="password" id="password" placeholder="Password" required>
              </div>
              <div class="form-group">
                <label for="image" class="form-label">Upload Foto (Opsional)</label>
                <input class="form-control" type="file" id="image" name="image">
              </div>
              <div class="form-group">
                <label for="role">Role<span class="text-danger">*</span></label>
                <select name="role" class="form-control" id="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary me-2">Submit</button>
              <a class="btn btn-light" href="{{ route('admin.users.index') }}">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  @if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal Menambahkan User',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonColor: '#d33'
        });
    </script>
  @endif
@endsection
