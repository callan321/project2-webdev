@extends('layouts.app')


@section('content')
    <div class="flex h-screen w-full justify-center items-center">
        <a href="{{ route('login') }}" class="w-20 justify-center items-center flex">
            <x-button>Login</x-button>
        </a>
    </div>
@endsection
