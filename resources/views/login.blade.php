@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('login') }}" class="max-w-md mx-auto p-6 bg-white shadow-md rounded-lg space-y-6">
        @csrf

        <!-- Username Field (role + number combined) -->
        <x-input
            id="username"
            name="username"
            label="Username (Role + Number)"
            placeholder="e.g. A1234567"
            required autofocus
        />

        <x-password
            id="password"
            name="password"
            label="Password"
            required
        />
        <!-- Submit Button -->
        <x-button>Login</x-button>
    </form>
@endsection
