@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Kamar</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rooms.update', $room->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>No Kamar</label>
            <input type="text" name="room_number" value="{{ $room->room_number }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tipe Kamar</label>
            <input type="text" name="type" value="{{ $room->type }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga per Malam</label>
            <input type="number" name="price" value="{{ $room->price }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="is_available" class="form-control">
                <option value="1" {{ $room->is_available ? 'selected' : '' }}>Tersedia</option>
                <option value="0" {{ !$room->is_available ? 'selected' : '' }}>Tidak Tersedia</option>
            </select>
        </div>
        <button class="btn btn-primary">Perbarui</button>
        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
