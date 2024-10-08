@extends('layouts.authenticated')

@section('main')
    <div class="max-w-4xl mx-auto py-10 bg-white rounded-lg shadow-lg px-6">
        <!-- Teacher Controls -->
        @if (auth()->user()->role == 't')
            <!-- Alert if reviews have been submitted -->
            @if ($assessment->reviews()->exists())
                <div class="bg-yellow-100 text-yellow-700 p-4 rounded mb-6">
                    <strong>Note:</strong> Reviews have already been submitted for this assessment. It can no longer be edited.
                </div>
                <a href="{{ route('reviews.marking', $assessment->id) }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500">Go to Marking Page</a>
            @else
                <a href="{{ route('assessments.edit', $assessment->id) }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500">Edit Assessment</a>
            @endif
        @endif

        <!-- Assessment Title -->
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">{{ $assessment->name }}</h1>

        <!-- Course Name -->
        <h2 class="text-xl font-semibold mb-4 text-gray-700">Course: {{ $course->name }} ({{ $course->code }})</h2>

        <!-- Instructions -->
        <div class="mb-6">
            <h3 class="text-xl font-semibold mb-2">Instructions:</h3>
            <p class="text-gray-600">{{ $assessment->instruction }}</p>
        </div>

        <!-- Due Date & Time -->
        <div class="mb-6">
            <h3 class="text-xl font-semibold mb-2">Due Date & Time:</h3>
            <p class="text-gray-600">
                @if ($assessment->due_date)
                    {{ $assessment->due_date->format('F j, Y') }} at {{ $assessment->due_time->format('H:i') }}
                @else
                    <span class="text-red-500">No due date set</span>
                @endif
            </p>
        </div>

        <!-- Number of Reviews Required -->
        <div class="mb-6">
            <h3 class="text-xl font-semibold mb-2">Number of Reviews Required:</h3>
            <p class="text-gray-600">{{ $assessment->number_of_reviews }}</p>
        </div>

        <!-- Maximum Score -->
        <div class="mb-6">
            <h3 class="text-xl font-semibold mb-2">Maximum Score:</h3>
            <p class="text-gray-600">{{ $assessment->max_score }}</p>
        </div>

        <!-- Peer Review Type -->
        <div class="mb-6">
            <h3 class="text-xl font-semibold mb-2">Peer Review Type:</h3>
            <p class="text-gray-600 capitalize">{{ $assessment->type }}</p>
        </div>

        <!-- Submit a Peer Review (Students Only) -->
        @if (auth()->user()->role == 's')
            <a href="{{ route('reviews.create', $assessment->id) }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500">Submit a Peer Review</a>
        @endif

        <!-- Display received peer reviews (Students Only) -->
        @if (auth()->user()->role == 's')
            <div class="mt-10">
                <h3 class="text-xl font-semibold mb-4">Reviews You Have Received:</h3>

                @if ($receivedReviews->isEmpty())
                    <p class="text-gray-600">You have not received any reviews yet.</p>
                @else
                    <ul class="space-y-4">
                        @foreach ($receivedReviews as $review)
                            <li class="bg-gray-100 p-4 rounded shadow">
                                <strong>Reviewer:</strong> {{ $review->reviewer->name }} <br>
                                <strong>Review:</strong>
                                <br/>
                                <pre class="whitespace-pre-wrap">{{ $review->review_text }}</pre>
                                @if($review->score !== null) <!-- Only display the score if it's set -->
                                <strong>Score:</strong> {{ $review->score }}/{{ $assessment->max_score }}
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endif
    </div>
@endsection
