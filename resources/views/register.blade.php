@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('register') }}" class="max-w-md mx-auto p-6 bg-white shadow-md rounded-lg space-y-6">
        @csrf

        <!-- Name input with error message -->
        <x-input
            id="name"
            name="name"
            label="Name"
            required autofocus
        />
        @error('name')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <!-- Email input with error message -->
        <x-input
            id="email"
            name="email"
            label="Email"
            required autofocus
        />
        @error('email')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <!-- Role input with error message -->
        <x-input
            id="role"
            name="role"
            label="Role"
            required autofocus
        />
        @error('role')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <!-- Number input with error message -->
        <x-input
            id="number"
            name="number"
            label="Number"
            required autofocus
        />
        @error('number')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <!-- Password input with error message -->
        <x-password
            id="password"
            name="password"
            label="Password"
            required
        />
        @error('password')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <!-- Submit Button -->
        <x-button>Register</x-button>
    </form>
@endsection
