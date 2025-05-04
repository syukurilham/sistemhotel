@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Kamar Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rooms.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>No Kamar</label>
            <input type="text" name="room_number" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tipe Kamar</label>
            <select name="type" id="type" class="w-full border rounded px-3 py-2">
            <option value="Standard" {{ old('type', $room->type ?? '') == 'Standard' ? 'selected' : '' }}>Standard</option>
            <option value="Deluxe" {{ old('type', $room->type ?? '') == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
            <option value="Suite" {{ old('type', $room->type ?? '') == 'Suite' ? 'selected' : '' }}>Suite</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Harga per Malam</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="is_available" class="form-control">
                <option value="1">Tersedia</option>
                <option value="0">Tidak Tersedia</option>
            </select>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
