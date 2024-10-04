@extends('layouts.authenticated')

@section('main')
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6">Welcome, {{ Auth::user()->name }}!</h1>

        <div class="mb-6">
            <p class="text-lg"><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p class="text-lg"><strong>Number:</strong> {{ Auth::user()->role }}{{ Auth::user()->number }}</p>
        </div>

        @if(Auth::user()->role == 't')
            <!-- Display courses the teacher is teaching -->
            <h2 class="text-2xl font-semibold mt-8 mb-4">Courses You are Teaching:</h2>
            @if($enrolledCourses->isEmpty())
                <p class="text-gray-500">You are not teaching any courses.</p>
            @else
                <ul class="space-y-2">
                    @foreach($enrolledCourses as $course)
                        <li>
                            <a href="{{ route('courses.show', $course->code) }}" class="text-blue-500 hover:underline">
                                {{ $course->code }} : {{ $course->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        @else
            <!-- Display enrolled courses for students -->
            <h2 class="text-2xl font-semibold mt-8 mb-4">Your Enrolled Courses:</h2>
            @if($enrolledCourses->isEmpty())
                <p class="text-gray-500">You are not enrolled in any courses.</p>
            @else
                <ul class="space-y-2">
                    @foreach($enrolledCourses as $course)
                        <li>
                            <a href="{{ route('courses.show', $course->code) }}" class="text-blue-500 hover:underline">
                                {{ $course->code }} : {{ $course->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        @endif
    </div>
@endsection
