@extends('layouts.app')

@section('content')

<div class="bg-gray-100 py-10 px-4 sm:px-8">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Pilih Kamar Anda</h1>

        {{-- Filter Kategori --}}
        <div class="mb-8 flex justify-center animate__animated animate__fadeIn">
            @php
            $currentType = request('type');
            $categories = ['' => 'Semua', 'Standard' => 'Standard', 'Deluxe' => 'Deluxe', 'Suite' => 'Suite'];
            @endphp

            <div class="flex gap-4 flex-wrap justify-center">
                @foreach ($categories as $value => $label)
                <a href="{{ route('rooms.index', ['type' => $value]) }}"
                    class="px-4 py-2 rounded-full border 
                    {{ $currentType === $value || ($currentType === null && $value === '') ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 hover:bg-indigo-100' }} 
                    transition-all duration-300 shadow-sm hover:shadow-md">
                    {{ $label }}
                </a>
                @endforeach
            </div>
        </div>


        {{-- Grid Kamar --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 animate__animated animate__fadeInUp">
            @forelse ($rooms as $room)
            <div class="bg-white rounded-2xl shadow-md overflow-hidden transform hover:scale-105 transition duration-300">
                <img src="{{ $room->image_url ?? 'https://source.unsplash.com/400x300/?hotel,room' }}" alt="Room Image" class="w-full h-48 object-cover">
                <div class="p-5">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Kamar {{ $room->room_number }} ({{ $room->type }})</h2>
                    <p class="text-gray-600 text-sm mb-1">Harga: <span class="font-bold text-indigo-600">Rp{{ number_format($room->price, 0, ',', '.') }}</span></p>
                    <p class="text-gray-600 text-sm mb-3">Status:
                        <span class="font-semibold {{ $room->is_available ? 'text-green-600' : 'text-red-500' }}">
                            {{ $room->is_available ? 'Tersedia' : 'Tidak Tersedia' }}
                        </span>
                    </p>
                    <a href="{{ route('reservations.create', ['room_id' => $room->id]) }}" class="inline-block px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition duration-300">
                        Reservasi Sekarang
                    </a>
                </div>
            </div>
            @empty
            <p class="text-center col-span-3 text-gray-500">Tidak ada kamar ditemukan.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection