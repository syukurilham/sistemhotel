@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100 px-4">
    <div class="bg-white rounded-xl shadow-md w-full max-w-md p-6">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Lupa Password</h2>

        <div class="mb-4 text-sm text-gray-600 text-center">
            Masukkan alamat email Anda dan kami akan mengirimkan tautan untuk mereset password Anda.
        </div>

        @if (session('status'))
            <div class="mb-4 text-green-600 font-medium text-sm text-center">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                              :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between pt-4">
                <a href="{{ route('login') }}"
                   class="text-sm text-gray-600 hover:text-indigo-600 underline">
                    Kembali ke Login
                </a>

                <x-primary-button>
                    {{ __('Kirim Tautan') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
@endsection
