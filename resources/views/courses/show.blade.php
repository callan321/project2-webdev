@extends('layouts.authenticated')

@section('main')
    <div class="max-w-4xl mx-auto py-10 px-6 bg-white shadow-lg rounded-lg">
        <!-- Course Name and Code -->
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">{{ $course->name }} ({{ $course->code }})</h1>

        <!-- Teachers can create a new assessment -->
        @if(auth()->user()->role === 't')
            <div class="mb-6 text-right">
                <a href="{{ route('assessments.create', $course->id) }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500">
                    Create Assessment
                </a>
            </div>
        @endif

        <!-- Teachers Section -->
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Teachers</h2>
        @if($teachers->isEmpty())
            <p class="text-gray-500 mb-6">No teachers assigned to this course.</p>
        @else
            <div class="mb-6">
                @foreach($teachers as $teacher)
                    <div class="flex items-center mb-2">
                        <span class="text-gray-800 font-medium">{{ $teacher->name }}</span>
                        <span class="ml-2 text-sm text-gray-600">({{ $teacher->email }})</span>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Students Section -->
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Students Enrolled</h2>
        @if($students->isEmpty())
            <p class="text-gray-500 mb-6">No students enrolled in this course.</p>
        @else
            <div class="mb-6">
                @foreach($students as $student)
                    <div class="flex items-center mb-2">
                        <span class="text-gray-800 font-medium">{{ $student->name }}</span>
                        <span class="ml-2 text-sm text-gray-600">({{ $student->email }})</span>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Assessments Section -->
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Assessments</h2>
        @if($assessments->isEmpty())
            <p class="text-gray-500">No assessments for this course.</p>
        @else
            <div>
                @foreach($assessments as $assessment)
                    <div class="flex items-center mb-2">
                        <a href="{{ route('assessments.show', $assessment->id) }}" class="text-indigo-600 hover:underline">
                            {{ $assessment->name }}
                        </a>
                        <span class="ml-2 text-sm text-gray-600">- Due: {{ $assessment->due_date->format('F j, Y') }}</span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
