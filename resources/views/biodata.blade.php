@extends('layouts.app')

{{-- <td>
  @if($user->image)
      <img src="{{ asset('storage/'.$user->image) }}" alt="Foto User" width="50" height="60" class="rounded-circle">
  @else
      <span>Tidak ada foto</span>
  @endif
</td> --}}

@section('content')
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

                <h6>Dosen Wali :</h6>
                <p class="text-muted">[Nama Dosen Wali]</p>

                <div>
                    <a href="#" class="text-primary mx-2"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-danger mx-2"><i class="fab fa-google"></i></a>
                    <a href="#" class="text-info mx-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-dark mx-2"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </div>

        <!-- Detail Kanan -->
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
                      <strong>Email:</strong> {{ $user->email }}
                    </li>
                    <li class="mb-2 fs-6">
                      <strong>Agama:</strong> {{ $user->agama ?? '-' }}</li>
                    <li class="mb-2 fs-6">
                      <strong>Status Kawin:</strong> {{ $user->status_kawin ?? '-' }}
                    </li class="mb-2 fs-6">
                    <li class="mb-2 fs-6">
                      <strong>Jenis Kelamin:</strong> {{ $user->jenis_kelamin ?? '-' }}
                    </li class="mb-2 fs-6">
                    <li class="mb-2 fs-6">
                      <strong>TTL:</strong> {{ $user->tempat_lahir ?? '-' }}, {{ $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('d F Y') : '-' }}
                    </li class="mb-2 fs-6">
                    <li class="mb-2 fs-6">
                      <strong>Alamat:</strong> {{ $user->alamat ?? '(Belum Tersedia)' }}
                    </li class="mb-2 fs-6">
                    <li class="mb-2 fs-6">
                      <strong>No HP:</strong> {{ $user->no_hp ?? '-' }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
