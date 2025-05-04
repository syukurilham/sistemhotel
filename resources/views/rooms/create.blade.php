@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-8 bg-white rounded-2xl shadow-xl mt-10">
    <h1 class="text-2xl font-bold text-indigo-700 mb-6">Tambah Kamar Baru</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold text-gray-700 mb-2">No Kamar</label>
            <input type="text" name="room_number" class="w-full border rounded px-4 py-2 focus:ring focus:ring-indigo-200" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold text-gray-700 mb-2">Tipe Kamar</label>
            <select name="type" class="w-full border rounded px-4 py-2 focus:ring focus:ring-indigo-200" required>
                <option value="Standard">Standard</option>
                <option value="Deluxe">Deluxe</option>
                <option value="Suite">Suite</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold text-gray-700 mb-2">Harga per Malam</label>
            <input type="number" name="price" class="w-full border rounded px-4 py-2 focus:ring focus:ring-indigo-200" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold text-gray-700 mb-2">Status</label>
            <select name="is_available" class="w-full border rounded px-4 py-2">
                <option value="1">Tersedia</option>
                <option value="0">Tidak Tersedia</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold text-gray-700 mb-2">Detail Kamar</label>
            <textarea name="description" rows="4" class="w-full border rounded px-4 py-2 focus:ring focus:ring-indigo-200"></textarea>
        </div>

        <div class="mb-6">
            <label class="block font-semibold text-gray-700 mb-2">Foto Kamar</label>
            <input type="file" name="image" accept="image/*" class="w-full border rounded px-4 py-2">
        </div>

        <div class="flex justify-between">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">Simpan</button>
            <a href="{{ route('rooms.index') }}" class="text-gray-600 hover:underline">Batal</a>
        </div>
    </form>
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
