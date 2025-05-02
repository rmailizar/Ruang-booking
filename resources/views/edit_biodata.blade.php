@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <h2 class="fw-bold">Edit User</h2>
    <div class="row">
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Formulir Data User</h4>
            @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session("success") }}'
                });
            </script>
            @endif
            <form class="forms-sample" action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
              <div class="form-group">
                <label for="email">Email<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{ $user->email }}" required>
              </div>
              <div class="form-group">
                <label for="password">Password (Kosongkan jika tidak diubah)</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
              </div>
              <div class="form-group">
                <label for="no_hp">No. HP<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="no_hp" id="no_hp" placeholder="No. HP" value="{{ $user->no_hp }}" required>
              </div>
              <div class="form-group">
                <label for="image" class="form-label">Update Foto (Kosongkan jika tidak diubah)</label>
                <input class="form-control" type="file" id="image" name="image">
              </div>
              <button type="submit" class="btn btn-primary me-2">Update</button>
              <a class="btn btn-light" href="{{ route('biodata') }}">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
