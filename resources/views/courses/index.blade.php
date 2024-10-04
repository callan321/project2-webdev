@extends('layouts.authenticated')

@section('main')
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Welcome, {{ Auth::user()->name }}!</h1>
        <p class="mb-2"><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p class="mb-2"><strong>Number:</strong> {{ Auth::user()->role }}{{ Auth::user()->number }}</p>

        @if(Auth::user()->role == 't')
            <!-- Display courses the user is teaching if the role is 't' -->
            <h2 class="text-xl font-semibold mt-6">Courses You are Teaching:</h2>
            @if($enrolledCourses->isEmpty())
                <p>You are not teaching any courses.</p>
            @else
                <ul class="list-disc list-inside">
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
            <h2 class="text-xl font-semibold mt-6">Your Enrolled Courses:</h2>
            @if($enrolledCourses->isEmpty())
                <p>You are not enrolled in any courses.</p>
            @else
                <ul class="list-disc list-inside">
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
