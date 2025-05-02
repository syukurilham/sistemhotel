@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100 px-4">
    <div class="bg-white rounded-xl shadow-md w-full max-w-md p-6">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Masuk ke HotelKu</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                    required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-sm text-indigo-600 hover:underline">
                        {{ __('Lupa password?') }}
                    </a>
                @endif
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between mt-6">
                <x-primary-button>
                    {{ __('Log in') }}
                </x-primary-button>

                <a href="{{ route('register') }}"
                    class="text-sm text-indigo-600 hover:underline">
                    {{ __('Belum punya akun? Daftar') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
