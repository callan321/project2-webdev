@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('login') }}" class="max-w-md mx-auto p-6 space-y-6">
        @csrf

        <!-- Username Field (role + number combined) -->
        <x-input
            id="username"
            name="username"
            label="Username (Role + Number)"
            placeholder="e.g. s12345678"
            required autofocus
        />
        <!-- Password Field -->
        <x-password
            id="password"
            name="password"
            label="Password"
            required
        />
        @error('password')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
        @error('username')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
        <!-- Submit Button -->
        <x-button>Login</x-button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-500">
        No account?
        <a href="/register" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Register Here</a>
    </p>
@endsection
