<nav class="bg-white shadow-md fixed top-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
        <a href="{{ url('/') }}" class="text-xl font-bold text-blue-600">HotelKu</a>
        <div class="hidden md:flex space-x-6">
            <a href="{{ url('/') }}" class="hover:text-blue-600 {{ request()->is('/') ? 'font-bold text-blue-600' : '' }}">Beranda</a>
            <a href="{{ route('rooms.index') }}" class="hover:text-blue-600 {{ request()->is('rooms*') ? 'font-bold text-blue-600' : '' }}">Kamar</a>
            <a href="#about" class="hover:text-blue-600">Tentang</a>
            <a href="#contact" class="hover:text-blue-600">Kontak</a>
        </div>
        <div class="hidden md:flex space-x-4">
            @auth
                <a href="{{ route('dashboard') }}" class="text-sm text-gray-700">Profil</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-sm text-red-600">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm text-blue-600">Login</a>
                <a href="{{ route('register') }}" class="text-sm text-blue-600">Daftar</a>
            @endauth
        </div>
        <!-- Hamburger -->
        <div class="md:hidden">
            <button id="nav-toggle" class="focus:outline-none">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>
    <!-- Mobile Menu -->
    <div id="nav-menu" class="md:hidden hidden px-4 pb-4">
        <a href="{{ url('/') }}" class="block py-2">Beranda</a>
        <a href="{{ route('rooms.index') }}" class="block py-2">Kamar</a>
        <a href="#about" class="block py-2">Tentang</a>
        <a href="#contact" class="block py-2">Kontak</a>
        @auth
            <a href="{{ route('dashboard') }}" class="block py-2">Profil</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block py-2 text-red-600">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="block py-2">Login</a>
            <a href="{{ route('register') }}" class="block py-2">Daftar</a>
        @endauth
    </div>

    <script>
        document.getElementById('nav-toggle').addEventListener('click', function () {
            document.getElementById('nav-menu').classList.toggle('hidden');
        });
    </script>
</nav>
