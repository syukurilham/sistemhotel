@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-semibold mb-6 text-center text-gray-800">Profil Saya</h1>

    {{-- Profil --}}
    <div class="bg-white p-6 rounded-lg shadow-md mb-10">
        <p class="text-gray-800 text-lg mb-2"><span class="font-medium">Nama:</span> {{ Auth::user()->name }}</p>
        <p class="text-gray-800 text-lg mb-2"><span class="font-medium">Email:</span> {{ Auth::user()->email }}</p>
        @if(Auth::user()->is_admin)
            <p class="text-gray-800 text-lg"><span class="font-medium">Role:</span> Admin</p>
        @endif
    </div>

    {{-- Riwayat Reservasi --}}
    <h2 class="text-xl font-semibold mb-4 text-gray-800">Riwayat Reservasi</h2>
    <div class="bg-white p-6 rounded-lg shadow-md mb-12">
        <table class="min-w-full bg-white">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Kamar</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Tipe</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse (Auth::user()->reservationsHistory as $res)
                <tr class="border-t">
                    <td class="px-6 py-4">Kamar {{ $res->room->room_number }}</td>
                    <td class="px-6 py-4">{{ $res->room->type }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="px-6 py-4 text-center text-gray-500">Tidak ada riwayat reservasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Logout --}}
    <div class="flex justify-end">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 text-white px-5 py-2 rounded hover:bg-red-700 transition">
                Logout
            </button>
        </form>
    </div>
</div>
@endsection
