@extends('layouts.authenticated')

@section('main')
    <div class="max-w-4xl mx-auto py-10">
        <!-- Assessment Title -->
        <h1 class="text-3xl font-bold mb-6 text-center">{{ $assessment->name }}</h1>

        <!-- Course Name -->
        <h2 class="text-xl font-semibold mb-4 text-gray-700">Course: {{ $course->name }} ({{ $course->code }})</h2>

        <!-- Assessment Instructions -->
        <div class="mb-8">
            <h3 class="text-xl font-semibold mb-2">Instructions:</h3>
            <p class="text-gray-600">{{ $assessment->instruction }}</p>
        </div>

        <!-- Due Date and Time -->
        <div class="mb-8">
            <h3 class="text-xl font-semibold mb-2">Due Date & Time:</h3>
            <p class="text-gray-600">
                @if ($assessment->due_date)
                    {{ $assessment->due_date->format('F j, Y') }}
                @else
                    <span class="text-red-500">No due date set</span>
                @endif
                at
                @if ($assessment->due_time)
                    {{ $assessment->due_time->format('H:i') }}
                @else
                    <span class="text-red-500">No due time set</span>
                @endif
            </p>
        </div>

        <!-- Number of Reviews Required -->
        <div class="mb-8">
            <h3 class="text-xl font-semibold mb-2">Number of Reviews Required:</h3>
            <p class="text-gray-600">{{ $assessment->number_of_reviews }}</p>
        </div>

        <!-- Maximum Score -->
        <div class="mb-8">
            <h3 class="text-xl font-semibold mb-2">Maximum Score:</h3>
            <p class="text-gray-600">{{ $assessment->max_score }}</p>
        </div>

        <!-- Peer Review Type -->
        <div class="mb-8">
            <h3 class="text-xl font-semibold mb-2">Peer Review Type:</h3>
            <p class="text-gray-600 capitalize">{{ $assessment->type }}</p>
        </div>
    </div>
@endsection
