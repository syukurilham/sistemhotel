@extends('layouts.app')

@section('content')
<div class="bg-white">
    <!-- Hero Section -->
    <section class="bg-cover bg-center h-screen relative" style="background-image: url('/images/hotel.jpg')">
        <div class="absolute inset-0 bg-black bg-opacity-60 flex items-center justify-center">
            <div class="text-center text-white px-4">
                <h1 class="text-4xl sm:text-6xl font-bold mb-4 animate-fade-in-down">Selamat Datang di HotelKu</h1>
                <p class="text-lg mb-6 animate-fade-in-up">Pesan kamar impianmu dengan mudah dan cepat</p>
                <a href="{{ route('rooms.index') }}" class="bg-blue-600 px-6 py-3 rounded-lg text-white hover:bg-blue-700 transition">Lihat Kamar</a>
            </div>
        </div>
    </section>

    <!-- Tentang -->
    <section id="about" class="py-16 px-4 text-center max-w-5xl mx-auto">
        <h2 class="text-3xl font-bold mb-4">Tentang Kami</h2>
        <p class="text-gray-600">HotelKu adalah hotel modern dengan fasilitas terbaik dan pelayanan prima. Kami menyediakan berbagai tipe kamar yang nyaman untuk liburan maupun perjalanan bisnis Anda.</p>
    </section>

    <!-- Fitur -->
    <section class="bg-gray-100 py-16 px-4">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                <div class="mb-4 text-blue-600 text-4xl">🛏️</div>
                <h3 class="text-xl font-semibold mb-2">Kamar Nyaman</h3>
                <p class="text-gray-500">Kamar bersih, modern, dan nyaman dengan pemandangan indah.</p>
            </div>
            <div class="text-center p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                <div class="mb-4 text-blue-600 text-4xl">📶</div>
                <h3 class="text-xl font-semibold mb-2">WiFi Cepat</h3>
                <p class="text-gray-500">Akses internet cepat untuk mendukung kegiatan online Anda.</p>
            </div>
            <div class="text-center p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                <div class="mb-4 text-blue-600 text-4xl">📍</div>
                <h3 class="text-xl font-semibold mb-2">Lokasi Strategis</h3>
                <p class="text-gray-500">Dekat pusat kota, pusat belanja, dan transportasi umum.</p>
            </div>
        </div>
    </section>

    <!-- Kontak -->
    <section id="contact" class="py-16 px-4 bg-white max-w-4xl mx-auto text-center">
        <h2 class="text-3xl font-bold mb-6">Hubungi Kami</h2>
        <p class="text-gray-600 mb-4">Telepon: (021) 123-456 | Email: info@hotelku.com</p>
        <a href="mailto:info@hotelku.com" class="inline-block mt-4 bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Kirim Email</a>
    </section>
</div>
@endsection
