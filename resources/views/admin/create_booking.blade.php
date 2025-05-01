@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <h4>Form Peminjaman Ruangan: {{ $room->name }}</h4>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Form Data Peminjaman</h4>
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
                <label for="tanggal">TANGGAL & JAM MULAI<span class="text-danger">*</span></label>
                <input type="datetime-local" id="tanggal" class="form-control" name="start_time" required>
              </div>
              <div class="form-group">
                <label for="tanggal">TANGGAL & JAM SELESAI<span class="text-danger">*</span></label>
                <input type="datetime-local" id="tanggal" class="form-control" name="end_time" required>
              </div>
              <div class="form-group">
                <label for="peserta">JUMLAH PESERTA<span class="text-danger">*</span></label>
                <input type="number" id="peserta" class="form-control" name="jml_peserta" required>
              </div>
              <div class="form-group">
                <label for="reason">ACARA/KEGIATAN<span class="text-danger">*</span></label>
                <textarea class="form-control" id="reason" name="reason"></textarea>
              </div>
              <div class="form-group">
                <label for="catatan">CATATAN (Opsional)</label>
                <textarea class="form-control" id="catatan" name="catatan"></textarea>
              </div>
              <button type="submit" class="btn btn-primary me-2">Submit</button>
              <a class="btn btn-light" href="{{ route('bookings.roomList') }}">Cancel</a>
            </form>
          </div>
        </div>
      </div>
      {{-- Jadwal Peminjaman Ruangan --}}
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Jadwal Peminjaman Ruangan: {{ $room->name }}</h4>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Waktu Mulai</th>
                            <th>Waktu Selesai</th>
                            <th>Acara/Kegiatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $index => $booking)
                            <tr class="text-center">
                                <td>{{ $bookings->firstItem() + $index }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->start_time)->format('d/m/Y H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->end_time)->format('d/m/Y H:i') }}</td>
                                <td>{{ $booking->reason ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Belum ada peminjaman untuk ruangan ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
                <div class="d-flex justify-content-end mt-3">
                    {{ $bookings->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    {{-- End Jadwal Peminjaman Ruangan --}}
    </div>
  </div>

  {{-- Notif Error invalid date --}}
  @if (session('invalid_date'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('invalid_date') }}',
        });
    </script>
@endif
@endsection
