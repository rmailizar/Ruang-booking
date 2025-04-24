@extends('layouts.app')

@section('content')
    <h2>Edit Room</h2>
    <form action="{{ route('rooms.update', $room) }}" method="POST">
        @csrf @method('PUT')
        <input type="text" name="name" value="{{ $room->name }}" required><br>
        <input type="text" name="location" value="{{ $room->location }}" required><br>
        <input type="number" name="capacity" value="{{ $room->capacity }}" required><br>
        <textarea name="description">{{ $room->description }}</textarea><br>
        <button type="submit">Update</button>
    </form>
@endsection
