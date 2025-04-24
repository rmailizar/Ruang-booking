@extends('layouts.app')

@section('content')
    <h4>Form Peminjaman Ruangan: {{ $room->name }}</h4>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
<div class="content-wrapper">
    <div class="row">
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Formulir Booking</h4>
            <form class="forms-sample" action="{{ route('bookings.store') }}" method="POST">
                @csrf
                <input type="hidden" name="room_id" value="{{ $room->id }}">
              <div class="form-group">
                <label for="name">NAMA RUANGAN</label>
                <input type="text" class="form-control" id="name" value="{{ $room->name }}" readonly>
              </div>
              <div class="form-group">
                <label for="lokasi">LOKASI</label>
                <input type="text" class="form-control" name="location" id="lokasi" placeholder="Location" value="{{ $room->location }}" readonly>
              </div>
              <div class="form-group">
                <label for="tanggal">TANGGAL & JAM MULAI</label>
                <input type="datetime-local" id="tanggal" class="form-control" name="start_time" required>
              </div>
              <div class="form-group">
                <label for="tanggal">TANGGAL & JAM SELESAI</label>
                <input type="datetime-local" id="tanggal" class="form-control" name="end_time" required>
              </div>
              <div class="form-group">
                <label for="peserta">JUMLAH PESERTA</label>
                <input type="number" id="peserta" class="form-control" name="jml_peserta" required>
              </div>
              <div class="form-group">
                <label for="reason">ACARA/KEGIATAN</label>
                <textarea class="form-control" id="reason" name="reason"></textarea>
              </div>
              <div class="form-group">
                <label for="catatan">CATATAN</label>
                <textarea class="form-control" id="catatan" name="catatan"></textarea>
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
