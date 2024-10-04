@extends('layouts.authenticated')

@section('main')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-6">Enroll a Student into a Course</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('enrollments.store') }}" method="POST">
            @csrf

            <!-- Select Student -->
            <div class="mb-4">
                <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">Select Student</label>
                <select name="user_id" id="user_id" class="block appearance-none w-full bg-gray-200 border border-gray-300 text-gray-700 py-2 px-3 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                    <option value="">-- Choose Student --</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Select Course -->
            <div class="mb-4">
                <label for="course_id" class="block text-gray-700 text-sm font-bold mb-2">Select Course</label>
                <select name="course_id" id="course_id" class="block appearance-none w-full bg-gray-200 border border-gray-300 text-gray-700 py-2 px-3 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                    <option value="">-- Choose Course --</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Enroll Student
                </button>
            </div>
        </form>
    </div>
@endsection
