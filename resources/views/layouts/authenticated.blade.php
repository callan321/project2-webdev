@extends('layouts.app')

@section('content')
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="flex flex-col w-64 bg-gray-800 text-white min-h-full shadow-lg">
            <!-- Sidebar Middle Section: User Info -->
            <div class="flex items-center justify-between p-4 border-b border-gray-700">
                <div class="text-md">
                    {{ Auth::user()->name }} <br>
                    <span class="text-sm">{{ Auth::user()->role == 't' ? 'Teacher' : 'Student' }}</span>
                </div>
            </div>

            <!-- Sidebar Navigation Links -->
            <nav class="flex-grow p-4">
                <a href="/home" class="block mb-4  font-medium text-gray-300 hover:text-white">Home</a>
                
                <!-- Teacher only   Links -->
                @if(Auth::user()->role == 't')
                    <a href="{{ route('enrollments.create') }}" class="block mb-4 font-medium text-gray-300 hover:text-white">
                        Enroll Students
                    </a>
                @endif
            </nav>

            <!-- Sidebar Bottom Section: Logout Button -->
            <div class="p-4 border-t border-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left text-gray-300 hover:text-white">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex flex-col flex-grow p-6 overflow-auto bg-gray-100">
            <main class="flex-grow">
                @yield('main')
            </main>
        </div>
    </div>
@endsection
