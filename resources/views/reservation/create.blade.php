@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reservasi Kamar</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Pilih Kamar</label>
            <select name="room_id" class="form-control" required>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}">
                        Kamar {{ $room->room_number }} - {{ $room->type }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Check-In</label>
            <input type="date" name="check_in" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Check-Out</label>
            <input type="date" name="check_out" class="form-control" required>
        </div>
        <button class="btn btn-primary">Reservasi</button>
        <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
