@extends('layouts.app')

@section('content')
<div class="container py-16">
    <h1 class="text-2xl font-semibold mb-4">Profil Saya</h1>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <p class="text-xl">Nama: {{ Auth::user()->name }}</p>
        <p class="text-lg">Email: {{ Auth::user()->email }}</p>
        @if(Auth::user()->is_admin)
        <p class="text-lg">Role: Admin</p>
        @endif
    </div>
    <h2 class="text-2xl font-semibold mb-4">Riwayat Reservasi</h2>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <table class="min-w-full bg-white shadow-lg rounded-xl overflow-hidden">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Kamar</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Tipe</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse (Auth::user()->reservationsHistory as $res)
                <tr>
                    <td class="px-6 py-4">Kamar {{ $res->room->room_number }}</td>
                    <td class="px-6 py-4">{{ $res->room->type }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada riwayat reservasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">Logout</button>
        </form>
    </div>
</div>
@endsection