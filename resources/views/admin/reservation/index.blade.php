@extends('layouts.app')

@section('content')

<div class="py-10 px-4 sm:px-8 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Daftar Reservasi</h1>
        @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
        @endif

        <div class="overflow-x-auto bg-white rounded-xl shadow-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-indigo-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Nama Tamu</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Kamar</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Tanggal Masuk</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Tanggal Keluar</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($reservations as $res)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ $res->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $res->user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">#{{ $res->room->room_number }} ({{ $res->room->type }})</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $res->check_in }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $res->check_out }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold
                                {{ $res->status == 'confirmed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ ucfirst($res->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if ($reservations->isEmpty())
            <div class="p-4 text-center text-gray-500">Belum ada reservasi.</div>
            @endif
        </div>
    </div>
</div>
@endsection