@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center h-screen bg-gray-100">
        <form method="POST" action="{{ route('login') }}" class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
            @csrf

            <!-- Username Field (role + number) -->
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username (Role + Number)</label>
                <input type="text" id="username" name="username" placeholder="e.g. s12345678"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-gray-900 focus:border-gray-900"
                       required autofocus>
                @error('username')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-gray-900 focus:border-gray-900"
                       required>
                @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-500 focus:outline-none">
                    Login
                </button>
            </div>

            <!-- Register Link -->
            <p class="mt-6 text-center text-sm text-gray-500">
                No account?
                <a href="/register" class="font-semibold text-indigo-600 hover:text-indigo-500">Register Here</a>
            </p>
        </form>
    </div>
@endsection
