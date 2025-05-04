@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reservasi Kamar</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <input type="hidden" name="room_id" value="{{ $room->id }}">

        <div class="mb-3">
            <label>Kamar</label>
            <input type="text" class="form-control" value="Kamar {{ $room->room_number }} - {{ $room->type }}" disabled>
        </div>
        <div class="mb-3">
            <label>Check-In</label>
            <input type="date" name="check_in" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Check-Out</label>
            <input type="date" name="check_out" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Reservasi</button>
        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
