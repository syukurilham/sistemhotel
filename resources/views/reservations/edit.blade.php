@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen flex items-center justify-center py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl w-full bg-white rounded-xl shadow-lg p-8 space-y-6">
        <h1 class="text-3xl font-semibold text-center text-indigo-700">Edit Reservasi</h1>

        @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('reservations.update', $reservation->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Select Kamar -->
            <div class="mb-4">
                <label for="room_id" class="block text-sm font-medium text-gray-700">Kamar</label>
                <select name="room_id" id="room_id" class="w-full mt-2 p-3 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent">
                    @foreach ($rooms as $room)
                    <option value="{{ $room->id }}" {{ $room->id == $reservation->room_id ? 'selected' : '' }}>
                        Kamar {{ $room->room_number }} - {{ $room->type }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Check-In -->
            <div class="mb-4">
                <label for="check_in" class="block text-sm font-medium text-gray-700">Check-In</label>
                <input type="date" name="check_in" id="check_in" value="{{ $reservation->check_in }}" class="w-full mt-2 p-3 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent" required>
            </div>

            <!-- Check-Out -->
            <div class="mb-4">
                <label for="check_out" class="block text-sm font-medium text-gray-700">Check-Out</label>
                <input type="date" name="check_out" id="check_out" value="{{ $reservation->check_out }}" class="w-full mt-2 p-3 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent" required>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between items-center">
                <button type="submit" class="w-full sm:w-auto bg-indigo-600 text-white py-2 px-6 rounded-lg shadow-lg hover:bg-indigo-700 transition duration-300">Simpan Perubahan</button>
                <a href="{{ route('reservations.index') }}" class="w-full sm:w-auto text-indigo-600 hover:text-indigo-700 transition duration-300">Batal</a>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const errorAlert = document.getElementById('errorAlert');
        if (errorAlert) {
            setTimeout(() => {
                errorAlert.classList.add('transition', 'duration-500', 'ease-in-out');
                errorAlert.style.opacity = '0';
                setTimeout(() => {
                    errorAlert.remove();
                }, 500); // tunggu animasi selesai sebelum menghapus dari DOM
            }, 4000); // 4000ms = 4 detik
        }
    });
</script>

@endsection