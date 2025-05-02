@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Semua Reservasi</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Nama User</th>
                <th>No Kamar</th>
                <th>Tipe</th>
                <th>Check-In</th>
                <th>Check-Out</th>
                <th>Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $res)
                <tr>
                    <td>{{ $res->user->name }}</td>
                    <td>{{ $res->room->room_number }}</td>
                    <td>{{ $res->room->type }}</td>
                    <td>{{ $res->check_in }}</td>
                    <td>{{ $res->check_out }}</td>
                    <td>{{ $res->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
