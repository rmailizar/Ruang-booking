@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Peminjaman Ruangan</h2>

    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="user_id" class="form-label">Nama User</label>
            <select class="form-control" name="user_id" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $booking->user_id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->jurusan }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="room_id" class="form-label">Ruangan</label>
            <select class="form-control" name="room_id" required>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}" {{ $room->id == $booking->room_id ? 'selected' : '' }}>
                        {{ $room->name }} - {{ $room->location }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">Waktu Mulai</label>
            <input type="datetime-local" class="form-control" name="start_time" value="{{ \Carbon\Carbon::parse($booking->start_time)->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">Waktu Selesai</label>
            <input type="datetime-local" class="form-control" name="end_time" value="{{ \Carbon\Carbon::parse($booking->end_time)->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="mb-3">
            <label for="reason" class="form-label">Alasan</label>
            <textarea class="form-control" name="reason">{{ $booking->reason }}</textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ $booking->status == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ $booking->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>
@endsection
