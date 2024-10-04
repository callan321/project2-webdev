@extends('layouts.app')

@section('content')
    <div class="flex h-screen w-full justify-center items-center bg-gray-100">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-6">Welcome to Web Application University</h1>
            <p class="text-lg text-gray-700 mb-8">Sign in to get started!</p>

            <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-500 transition duration-300">
                Login
            </a>
        </div>
    </div>
@endsection
