@extends('layouts.app')

@section('content')
<div class="container py-16">
    <h1 class="text-2xl font-semibold mb-4">Profil Saya</h1>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <p class="text-xl">Nama: {{ Auth::user()->name }}</p>
        <p class="text-lg">Email: {{ Auth::user()->email }}</p>
        @if(Auth::user()->is_admin)
        <p class="text-lg">Role: Admin</p>
        @endif
    </div>
    <div class="mt-6">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">Logout</button>
        </form>
    </div>
</div>
@endsection