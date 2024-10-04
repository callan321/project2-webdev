@extends('layouts.authenticated')

@section('main')
    <div class="max-w-4xl mx-auto py-10 px-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-center">Enroll a Student into a Course</h1>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Enrollment Form -->
        <form action="{{ route('enrollments.store') }}" method="POST">
            @csrf

            <!-- Select Student -->
            <div class="mb-6">
                <label for="user_id" class="block text-sm font-medium text-gray-700">Select Student</label>
                <select name="user_id" id="user_id" class="mt-2 block w-full bg-gray-100 border border-gray-300 rounded py-2 px-3 focus:outline-none focus:bg-white focus:border-indigo-500" required>
                    <option value="">-- Choose Student --</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Select Course -->
            <div class="mb-6">
                <label for="course_id" class="block text-sm font-medium text-gray-700">Select Course</label>
                <select name="course_id" id="course_id" class="mt-2 block w-full bg-gray-100 border border-gray-300 rounded py-2 px-3 focus:outline-none focus:bg-white focus:border-indigo-500" required>
                    <option value="">-- Choose Course --</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-500">Enroll Student</button>
            </div>
        </form>
    </div>
@endsection
