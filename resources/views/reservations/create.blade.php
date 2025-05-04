@extends('layouts.app')

@section('content')

<div class="bg-gray-100 min-h-screen flex items-center justify-center py-20 px-4 sm:px-8">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 animate__animated animate__fadeIn">
        <!-- Kolom 1: Gambar -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg">
            <img src="{{ $room->image_url ? asset($room->image_url) : 'https://via.placeholder.com/600x400?text=No+Image' }}"
                alt="Room Image"
                class="w-full h-64 object-cover">
        </div>

        <!-- Kolom 2: Detail Kamar -->
        <div class="bg-white rounded-xl p-6 shadow-lg space-y-4">
            <h2 class="text-2xl font-bold text-indigo-700">Kamar {{ $room->room_number }} - {{ $room->type }}</h2>
            <p class="text-gray-600">Harga per malam: <span class="text-indigo-600 font-semibold">Rp{{ number_format($room->price, 0, ',', '.') }}</span></p>

            @if ($room->description)
            <div class="text-gray-700 text-sm">
                <p>{{ $room->description }}</p>
            </div>
            @else
            <div class="text-gray-700 text-sm">
                <p>tidak ada deskripsi yang ditampilkan</p>
            </div>
            <p class="text-sm text-gray-500 italic">* Informasi tambahan bisa ditambahkan sesuai data fasilitas yang tersedia.</p>
            @endif
        </div>

        <!-- Kolom 3: Formulir Reservasi -->
        <div class="bg-white rounded-xl p-6 shadow-lg">
            <h3 class="text-lg font-semibold mb-4 text-gray-800">Formulir Reservasi</h3>
            <form action="{{ route('reservations.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <input type="hidden" id="pricePerNight" value="{{ $room->price }}">

                <div>
                    <label class="block text-sm font-medium text-gray-700">Check-In</label>
                    <input type="date" name="check_in" id="checkIn" class="mt-1 block w-full border rounded-lg px-3 py-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Check-Out</label>
                    <input type="date" name="check_out" id="checkOut" class="mt-1 block w-full border rounded-lg px-3 py-2" required>
                </div>

                <!-- Total Harga -->
                <div class="mt-4 text-gray-800 font-semibold">
                    Total Harga: <span id="totalPrice" class="text-indigo-600">Rp0</span>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">Reservasi</button>
                <a href="{{ route('rooms.index') }}" class="block text-center mt-2 text-indigo-500 hover:underline">Batal</a>
            </form>
        </div>
    </div>
</div>

<!-- Skrip untuk menghitung total harga -->
<script>
    const checkIn = document.getElementById('checkIn');
    const checkOut = document.getElementById('checkOut');
    const totalPrice = document.getElementById('totalPrice');
    const pricePerNight = parseInt(document.getElementById('pricePerNight').value);

    function calculateTotal() {
        const start = new Date(checkIn.value);
        const end = new Date(checkOut.value);

        if (checkIn.value && checkOut.value && end > start) {
            const timeDiff = end - start;
            const days = timeDiff / (1000 * 3600 * 24);
            const total = days * pricePerNight;
            totalPrice.innerText = "Rp" + total.toLocaleString('id-ID');
        } else {
            totalPrice.innerText = "Rp0";
        }
    }

    checkIn.addEventListener('change', calculateTotal);
    checkOut.addEventListener('change', calculateTotal);
</script>

@endsection