@extends('layouts.authenticated')

@section('main')
    <div class="max-w-4xl mx-auto py-10 bg-white rounded-lg shadow-lg px-6">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Edit Assessment</h1>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('assessments.update', $assessment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Assessment Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Assessment Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full border border-gray-300 rounded" value="{{ old('name', $assessment->name) }}" required>
            </div>

            <!-- Course Information (Read-Only) -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Course</label>
                <p class="mt-1 block w-full bg-gray-100 p-2 rounded">{{ $course->name }} ({{ $course->code }})</p>

                <!-- Hidden input to keep course_id -->
                <input type="hidden" name="course_id" value="{{ $course->id }}">
            </div>

            <!-- Instructions -->
            <div class="mb-4">
                <label for="instruction" class="block text-sm font-medium text-gray-700">Instructions</label>
                <textarea name="instruction" id="instruction" rows="4" class="mt-1 block w-full border border-gray-300 rounded" required>{{ old('instruction', $assessment->instruction) }}</textarea>
            </div>

            <!-- Max Score -->
            <div class="mb-4">
                <label for="max_score" class="block text-sm font-medium text-gray-700">Max Score</label>
                <input type="number" name="max_score" id="max_score" class="mt-1 block w-full border border-gray-300 rounded" min="1" max="100" value="{{ old('max_score', $assessment->max_score) }}" required>
            </div>

            <!-- Due Date -->
            <div class="mb-4">
                <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                <input type="date" name="due_date" id="due_date" class="mt-1 block w-full border border-gray-300 rounded" value="{{ old('due_date', $assessment->due_date->format('Y-m-d')) }}" required>
            </div>

            <!-- Due Time -->
            <div class="mb-4">
                <label for="due_time" class="block text-sm font-medium text-gray-700">Due Time</label>
                <input type="time" name="due_time" id="due_time" class="mt-1 block w-full border border-gray-300 rounded" value="{{ old('due_time', $assessment->due_time->format('H:i')) }}" required>
            </div>

            <!-- Peer Review Type -->
            <div class="mb-6">
                <label for="type" class="block text-sm font-medium text-gray-700">Peer Review Type</label>
                <select name="type" id="type" class="mt-1 block w-full border border-gray-300 rounded" required>
                    <option value="student-select" @if($assessment->type == 'student-select') selected @endif>Student Select</option>
                    <option value="teacher-assign" @if($assessment->type == 'teacher-assign') selected @endif>Teacher Assign</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-500">Update Assessment</button>
            </div>
        </form>
    </div>
@endsection
