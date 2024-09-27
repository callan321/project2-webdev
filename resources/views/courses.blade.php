@extends('layouts.authenticated')

@section('main')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">{{ $course->name }} ({{ $course->code }})</h1>

        <!-- Teachers Section -->
        <h2 class="text-xl font-semibold mb-2">Teachers</h2>
        @if($teachers->isEmpty())
            <p class="text-gray-500 mb-4">No teachers assigned to this course.</p>
        @else
            <ul class="list-disc list-inside mb-4">
                @foreach($teachers as $teacher)
                    <li class="mb-1">{{ $teacher->name }} ({{ $teacher->email }})</li>
                @endforeach
            </ul>
        @endif

        <!-- Students Section -->
        <h2 class="text-xl font-semibold mb-2">Students Enrolled</h2>
        @if($students->isEmpty())
            <p class="text-gray-500 mb-4">No students enrolled in this course.</p>
        @else
            <ul class="list-disc list-inside mb-4">
                @foreach($students as $student)
                    <li class="mb-1">{{ $student->name }} ({{ $student->email }})</li>
                @endforeach
            </ul>
        @endif

        <!-- Assessments Section -->
        <h2 class="text-xl font-semibold mb-2">Assessments</h2>
        @if($assessments->isEmpty())
            <p class="text-gray-500 mb-4">No assessments for this course.</p>
        @else
            <ul class="list-disc list-inside mb-4">
                @foreach($assessments as $assessment)
                    <li class="mb-1">
                        <a href="javascript:void(0)" class="text-blue-500 hover:underline">
                            {{ $assessment->name }}
                        </a> - Due: {{ $assessment->due_date->format('F j, Y') }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
