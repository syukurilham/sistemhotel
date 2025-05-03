<nav class="bg-white shadow-md fixed top-0 w-full z-50 animate__animated animate__fadeInDown">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
        <a href="{{ url('/') }}" class="text-xl font-bold text-blue-600">HotelKu</a>

        <div class="hidden md:flex space-x-6">
            <a href="{{ url('/') }}"
                class="hover:text-blue-600 transition duration-300 {{ request()->is('/') ? 'font-bold text-blue-600 border-b-2 border-blue-600' : '' }}">
                Beranda
            </a>
            <a href="{{ route('rooms.index') }}"
                class="hover:text-blue-600 transition duration-300 {{ request()->is('rooms*') ? 'font-bold text-blue-600 border-b-2 border-blue-600' : '' }}">
                Kamar
            </a>
            <a href="{{ url('/#about') }}"
                class="hover:text-blue-600 transition duration-300 {{ request()->fullUrlIs('*#about') ? 'font-bold text-blue-600 border-b-2 border-blue-600' : '' }}">
                Tentang
            </a>
            <a href="{{ url('/#contact') }}"
                class="hover:text-blue-600 transition duration-300 {{ request()->fullUrlIs('*#contact') ? 'font-bold text-blue-600 border-b-2 border-blue-600' : '' }}">
                Kontak
            </a>
        </div>

        <div class="hidden md:flex space-x-4 items-center relative">
            @auth
            @if(Auth::user()->is_admin)
                    <!-- Admin Dropdown with Hover -->
                    <div class="relative group">
                        <button class="flex items-center gap-1 text-sm text-gray-700 font-medium focus:outline-none">
                            {{ Auth::user()->name }}
                            <svg class="w-4 h-4 fill-current text-gray-700" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.25 7.5l4.5 4.5 4.5-4.5H5.25z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div
                            class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg opacity-0 invisible group-hover:visible group-hover:opacity-100 transition duration-300 z-40">
                            <a href="{{ route('admin.profile') }}" class="block px-4 py-2 hover:bg-gray-100">Profil Admin</a>
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-100">Dashboard</a>
                        </div>
                    </div>
                @else
                    <!-- Nama User -->
                    <a href="{{ route('users.profile') }}" class="text-sm text-gray-700 font-medium hover:text-blue-600">
                        {{ Auth::user()->name }}
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:text-blue-800 transition">Login</a>
                <a href="{{ route('register') }}" class="text-sm text-blue-600 hover:text-blue-800 transition">Daftar</a>
            @endauth
        </div>

        <!-- Hamburger Menu -->
        <div class="md:hidden">
            <button id="nav-toggle" class="focus:outline-none">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="nav-menu" class="md:hidden hidden px-4 pb-4 animate__animated animate__fadeInDown">
        <a href="{{ url('/') }}" class="block py-2 {{ request()->is('/') ? 'font-bold text-blue-600' : '' }}">Beranda</a>
        <a href="{{ route('rooms.index') }}" class="block py-2 {{ request()->is('rooms*') ? 'font-bold text-blue-600' : '' }}">Kamar</a>
        <a href="{{ url('/#about') }}" class="block py-2">Tentang</a>
        <a href="{{ url('/#contact') }}" class="block py-2">Kontak</a>
        @auth
            @if(Auth::user()->is_admin)
                <a href="{{ route('admin.profile') }}" class="block py-2">Profil Admin</a>
                <a href="{{ route('admin.dashboard') }}" class="block py-2">Dashboard</a>
            @else
                <a href="{{ route('users.profile') }}" class="block py-2">{{ Auth::user()->name }}</a>
            @endif
        @else
            <a href="{{ route('login') }}" class="block py-2">Login</a>
            <a href="{{ route('register') }}" class="block py-2">Daftar</a>
        @endauth
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const navToggle = document.getElementById('nav-toggle');
            const navMenu = document.getElementById('nav-menu');

            navToggle.addEventListener('click', function () {
                navMenu.classList.toggle('hidden');
            });
        });
    </script>
</nav>
