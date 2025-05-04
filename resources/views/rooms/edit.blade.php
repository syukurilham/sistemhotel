@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-2xl bg-white shadow-xl rounded-xl p-8 animate__animated animate__fadeIn">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 text-center">Edit Kamar</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('rooms.update', $room->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Kamar</label>
                <input type="text" name="room_number" value="{{ $room->room_number }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Kamar</label>
                <input type="text" name="type" value="{{ $room->type }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga per Malam</label>
                <input type="number" name="price" value="{{ $room->price }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="is_available"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="1" {{ $room->is_available ? 'selected' : '' }}>Tersedia</option>
                    <option value="0" {{ !$room->is_available ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
            </div>

            <div class="flex justify-between items-center mt-8">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition duration-300">
                    Perbarui
                </button>
                <a href="{{ route('rooms.index') }}"
                    class="text-indigo-600 hover:underline text-sm font-medium">Batal</a>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
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
