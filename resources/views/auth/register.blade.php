@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100 px-4">
    <div class="bg-white rounded-xl shadow-md w-full max-w-md p-6">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Daftar Akun HotelKu</h2>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nama Lengkap')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                    :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email')" required autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                    required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between mt-6">
                <x-primary-button>
                    {{ __('Daftar') }}
                </x-primary-button>

                <a href="{{ route('login') }}"
                    class="text-sm text-indigo-600 hover:underline">
                    {{ __('Sudah punya akun? Masuk') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
