@extends('layouts.authenticated')


@section('main')
    <div class="bg-white p-6 rounded-lg shadow-lg">
        @auth
            <h1 class="text-2xl font-bold mb-4">Welcome, {{ Auth::user()->name }}!</h1>
            <p class="mb-2"><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p class="mb-2"><strong>Number:</strong> {{ Auth::user()->number }}</p>
            <p class="mb-2"><strong>Role:</strong> {{ Auth::user()->role }}</p>
        @else
            <p class="text-xl">You are not logged in.</p>
        @endauth
    </div>
@endsection


