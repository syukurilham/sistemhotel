@extends('layouts.app')

@section('content')


<div class="bg-gray-50 min-h-screen py-12 px-4 sm:px-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6 animate__animated animate__fadeInDown">Reservasi Anda</h1>

        @if (session('success'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded shadow animate__animated animate__fadeIn">
            {{ session('success') }}
        </div>
        @endif

        <div class="overflow-x-auto animate__animated animate__fadeInUp">
            <table class="min-w-full bg-white shadow-lg rounded-xl overflow-hidden">
                <thead class="bg-indigo-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Kamar</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Tipe</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Total Harga</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Check-In</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Check-Out</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($reservations as $res)
                    <tr class="border-t hover:bg-gray-50 transition">
                        <td class="px-6 py-4">Kamar {{ $res->room->room_number }}</td>
                        <td class="px-6 py-4">{{ $res->room->type }}</td>
                        <td class="px-6 py-4">
                            Rp{{ number_format((\Carbon\Carbon::parse($res->check_out)->diffInDays(\Carbon\Carbon::parse($res->check_in))) * $res->room->price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4">{{ $res->check_in }}</td>
                        <td class="px-6 py-4">{{ $res->check_out }}</td>
                        @can('admin')
                            <form action="{{ route('reservations.checkout', $res->id) }}" method="POST" class="inline">
                                @csrf
                                <button onclick="return confirm('Check out reservasi ini?')" class="px-3 py-1 text-sm bg-green-500 text-white rounded hover:bg-green-600">Check Out</button>
                            </form>
                        @endcan
                        <td class="px-6 py-4 text-center space-x-2">
                            <a href="{{ route('reservations.edit', $res->id) }}" class="inline-block px-3 py-1 text-sm bg-yellow-400 text-white rounded hover:bg-yellow-500">Edit</a>
                            <form action="{{ route('reservations.destroy', $res->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin ingin membatalkan reservasi ini?')" class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600">Batal</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada reservasi ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Error Alert (jika ada)
        const errorAlert = document.getElementById('errorAlert');
        if (errorAlert) {
            setTimeout(() => {
                errorAlert.classList.add('transition', 'duration-500', 'ease-in-out');
                errorAlert.style.opacity = '0';
                setTimeout(() => errorAlert.remove(), 500);
            }, 4000); // 4 detik
        }

        // Success Alert (jika ada)
        const successAlert = document.getElementById('successAlert');
        if (successAlert) {
            setTimeout(() => {
                successAlert.classList.add('transition', 'duration-500', 'ease-in-out');
                successAlert.style.opacity = '0';
                setTimeout(() => successAlert.remove(), 500);
            }, 4000); // 4 detik
        }
    });
</script>

@endsection