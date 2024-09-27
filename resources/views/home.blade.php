@extends('layouts.authenticated')

@section('main')
    <div class="bg-white p-6 rounded-lg shadow-lg">
        @auth
            <h1 class="text-2xl font-bold mb-4">Welcome, {{ Auth::user()->name }}!</h1>
            <p class="mb-2"><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p class="mb-2"><strong>Number:</strong> {{ Auth::user()->role }}{{ Auth::user()->number }}</p>

            <h2 class="text-xl font-semibold mt-6">Your Enrolled Courses:</h2>
            @if($enrolledCourses->isEmpty())
                <p>You are not enrolled in any courses.</p>
            @else
                <ul class="list-disc list-inside">
                    @foreach($enrolledCourses as $course)
                        <li>
                            <!-- Link to the course details page using the course code -->
                            <a href="{{ route('courses.show', $course->code) }}" class="text-blue-500 hover:underline">
                                {{ $course->code }} : {{ $course->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        @else
            <p class="text-xl">You are not logged in.</p>
        @endauth
    </div>
@endsection
