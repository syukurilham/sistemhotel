@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Riwayat Reservasi</h1>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Kamar</th>
                <th>Tipe</th>
                <th>Check-In</th>
                <th>Check-Out</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $res)
            <tr>
                <td>{{ $res->room->room_number }}</td>
                <td>{{ $res->room->type }}</td>
                <td>{{ $res->check_in }}</td>
                <td>{{ $res->check_out }}</td>
            </tr>
            @endforeach
        </tbody>
        <td>
            <a href="{{ route('reservations.edit', $res->id) }}" class="btn btn-sm btn-warning">Edit</a>

            <form action="{{ route('reservations.destroy', $res->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin membatalkan reservasi ini?')">Batal</button>
            </form>
        </td>

    </table>
</div>
@endsection