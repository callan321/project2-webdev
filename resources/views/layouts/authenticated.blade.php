@extends('layouts.app')

@section('content')
    <div class="flex h-screen">
        <!-- Sidebar (visible on md and above) -->
        <div class="hidden md:flex flex-col w-64 bg-gray-800 text-white min-h-full shadow-lg">
            <!-- Sidebar Middle Section: User Info -->
            <div class="flex items-center justify-between p-4 border-b border-gray-700">
                <div class="text-md">
                    {{ Auth::user()->name }} <br>
                    <span class="text-sm text-gray-400">{{ Auth::user()->role == 't' ? 'Teacher' : 'Student' }}</span>
                </div>
            </div>

            <!-- Sidebar Navigation Links -->
            <nav class="flex-grow p-4">
                <a href="/home" class="block mb-4 text-gray-300 hover:text-white transition-colors duration-150">
                    Home
                </a>

                <!-- Teacher-only Links -->
                @if(Auth::user()->role == 't')
                    <a href="{{ route('enrollments.create') }}" class="block mb-4 text-gray-300 hover:text-white transition-colors duration-150">
                        Enroll Students
                    </a>
                    <a href="{{ route('courses.create') }}" class="block mb-4 text-gray-300 hover:text-white transition-colors duration-150">
                        Create Course
                    </a>
                @endif
            </nav>

            <!-- Sidebar Bottom Section: Logout Button -->
            <div class="p-4 border-t border-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-300 hover:text-white transition-colors duration-150">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex flex-col md:flex-row flex-grow overflow-auto bg-gray-100">
            <!-- Topbar (visible below md) -->
            <header class="w-full bg-gray-800 text-white shadow-lg md:hidden animate-[slideDown_0.5s_ease-out]">
                <div class="flex justify-between items-center p-4 border-b border-gray-700">
                    <!-- User Info -->
                    <div class="text-md">
                        {{ Auth::user()->name }} <br>
                        <span class="text-sm text-gray-400">{{ Auth::user()->role == 't' ? 'Teacher' : 'Student' }}</span>
                    </div>

                    <!-- Dropdown Toggle Button -->
                    <div>
                        <button id="dropdownToggle" class="focus:outline-none">
                            <!-- SVG Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 -960 960 960" width="36px" fill="white"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
                        </button>
                    </div>
                </div>

                <!-- Dropdown Menu (hidden by default) -->
                <nav id="dropdownMenu" class="hidden flex-col bg-gray-800 text-white border-t border-gray-700 pb-2">
                    <a href="/home" class="block py-2 px-4 text-gray-300 hover:text-white transition-colors duration-150 border-b border-gray-700">
                        Home
                    </a>

                    @if(Auth::user()->role == 't')
                        <a href="{{ route('enrollments.create') }}" class="block py-2 px-4 text-gray-300 hover:text-white transition-colors duration-150 border-b border-gray-700">
                            Enroll Students
                        </a>
                        <a href="{{ route('courses.create') }}" class="block py-2 px-4 text-gray-300 hover:text-white transition-colors duration-150 border-b border-gray-700">
                            Create Course
                        </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" class="py-2 px-4">
                        @csrf
                        <button type="submit" class="text-gray-300 hover:text-white transition-colors duration-150 w-full text-left">
                            Logout
                        </button>
                    </form>
                </nav>

            </header>

            <main class="flex-grow md:p-16">
                @yield('main')
            </main>
        </div>
    </div>

    <script>
        document.getElementById('dropdownToggle').addEventListener('click', function() {
            var menu = document.getElementById('dropdownMenu');
            menu.classList.toggle('hidden');
        });
    </script>
@endsection
