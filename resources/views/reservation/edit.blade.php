@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Reservasi</h1>

    <form method="POST" action="{{ route('reservations.update', $reservation->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Kamar</label>
            <select name="room_id" class="form-control">
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}" {{ $room->id == $reservation->room_id ? 'selected' : '' }}>
                        Kamar {{ $room->room_number }} - {{ $room->type }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Check-In</label>
            <input type="date" name="check_in" value="{{ $reservation->check_in }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Check-Out</label>
            <input type="date" name="check_out" value="{{ $reservation->check_out }}" class="form-control" required>
        </div>

        <button class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
