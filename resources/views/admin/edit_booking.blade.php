@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <h2>Edit Booking</h2>
    <div class="row">
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Formulir Edit Booking</h4>
            <form class="forms-sample" action="{{ route('bookings.update', $booking) }}" method="POST">
                @csrf @method('PUT')

                <div class="form-group">
                    <label for="room_id">Pilih Ruangan</label>
                    <select name="room_id" id="room_id" class="form-control" required>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" {{ $booking->room_id == $room->id ? 'selected' : '' }}>
                                {{ $room->name }} (Kapasitas: {{ $room->capacity }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="start_time">Waktu Mulai</label>
                    <input type="datetime-local" class="form-control" name="start_time" id="start_time" 
                           value="{{ \Carbon\Carbon::parse($booking->start_time)->format('Y-m-d\TH:i') }}" required>
                </div>

                <div class="form-group">
                    <label for="end_time">Waktu Selesai</label>
                    <input type="datetime-local" class="form-control" name="end_time" id="end_time" 
                           value="{{ \Carbon\Carbon::parse($booking->end_time)->format('Y-m-d\TH:i') }}" required>
                </div>

                <div class="form-group">
                    <label for="jml_peserta">Jumlah Peserta</label>
                    <input type="number" class="form-control" name="jml_peserta" id="jml_peserta" 
                           value="{{ $booking->jml_peserta }}" required>
                </div>

                <div class="form-group">
                    <label for="reason">Keperluan</label>
                    <input type="text" class="form-control" name="reason" id="reason" 
                           placeholder="Contoh: Rapat, Workshop" value="{{ $booking->reason }}">
                </div>

                <div class="form-group">
                    <label for="catatan">Catatan Tambahan</label>
                    <textarea name="catatan" class="form-control" id="catatan" placeholder="Tulis catatan tambahan...">{{ $booking->catatan }}</textarea><br>
                </div>

                <div class="form-group">
                    <label for="status">Status Booking</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ $booking->status == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ $booking->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary me-2">Update</button>
                <a class="btn btn-light" href="{{ route('bookings.index') }}">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection
