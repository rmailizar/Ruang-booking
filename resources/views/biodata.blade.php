@extends('layouts.app')

@section('content')
<div class="content-wrapper"> 
  <div class="container mt-5">
      <div class="row">
          <!-- Kartu kiri -->
          <div class="col-md-4 mb-4">
              <div class="card text-center p-3">
                  <div class="mx-auto mb-3">
                      @if ($user->image)
                          <img src="{{ asset('storage/'.$user->image) }}" alt="Foto" class="rounded-circle" width="120" height="120">
                      @else
                          <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width:120px; height:120px; font-size:40px;">
                              {{ strtoupper(substr($user->name, 0, 2)) }}
                          </div>
                      @endif
                  </div>
                  <h4 class="mb-0">{{ $user->name }}</h4>
                  <small>{{ $user->nim }}</small>
                  <p class="mt-2 text-primary fw-bold">Aktif</p>
  
                  <div class="mb-3">
                      <span class="badge bg-danger">{{ $user->jurusan }}</span>
                      <span class="badge bg-success">{{ date('Y') }}</span>
                  </div>
              </div>
          </div>
  
          <!-- Kartu Kanan -->
          <div class="col-md-8">
              <div class="card p-4">
                  <h5 class="fw-bold">Biodata User</h5>
                  <hr>
                  <ul class="list-unstyled">
                      <li class="mb-2 fs-6">
                        <i class="menu-icon mdi mdi-camera-front-variant text-primary"></i>
                        <strong>NIM:</strong> {{ $user->nim }}
                      </li>
                      <li class="mb-2 fs-6">
                        <i class="menu-icon mdi mdi-email text-primary"></i>
                        <strong>Email:</strong> {{ $user->email }}
                      </li>
                      <li class="mb-2 fs-6">
                        <i class="menu-icon mdi mdi-archive text-primary"></i>
                        <strong>Jurusan:</strong> {{ $user->jurusan ?? '-' }}</li>
                      <li class="mb-2 fs-6">
                        <i class="menu-icon mdi mdi-numeric-0-box-multiple-outline text-primary"></i>
                        <strong>No HP:</strong> {{ $user->no_hp ?? '-' }}
                      </li>
                      <li>
                        <a href="{{ route('profile.edit', $user->id) }}" class="btn rounded btn-sm btn-primary fw-bold text-decoration-none">Edit Profile</a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
