@extends('layouts.app')


@section('content')
    <h1 class="text-3xl font-bold underline">
        Hello world!
    </h1>
    <a href="{{ route('login') }}">Login</a>
@endsection
