@extends('layouts.authenticated')

@section('main')
    <div class="max-w-4xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6">Submit Review for {{ $assessment->name }}</h1>

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

        <!-- Review Submission Form -->
        <form action="{{ route('reviews.store', $assessment->id) }}" method="POST">
            @csrf

            <!-- For Students: Show the dropdown to select a student -->
            @if(auth()->user()->role == 's')
                <div class="mb-4">
                    <label for="reviewee_id" class="block font-medium">Select a Student to Review</label>
                    <select name="reviewee_id" class="block w-full" required>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>
            @else
                <!-- For Teachers: Reviewee already selected, show name -->
                <div class="mb-4">
                    <label for="reviewee_id" class="block font-medium">Reviewing</label>
                    <p class="block w-full bg-gray-100 p-2 rounded">{{ $reviewee->name }}</p>
                    <input type="hidden" name="reviewee_id" value="{{ $reviewee->id }}">
                </div>
            @endif

            <!-- Review Text -->
            <div class="mb-4">
                <label for="review_text" class="block font-medium">Write your review</label>
                <textarea name="review_text" rows="5" class="block w-full" required>{{ old('review_text') }}</textarea>
            </div>

            <!-- Only show the score field for teachers -->
            @if (auth()->user()->role == 't')
                <div class="mb-4">
                    <label for="score" class="block font-medium">Score (out of {{ $assessment->max_score }})</label>
                    <input type="number" name="score" id="score" class="block w-full" min="0" max="{{ $assessment->max_score }}" value="{{ old('score') }}" required>
                </div>
            @endif

            <button type="submit" class="bg-blue-600 text-white px-4 py-2">Submit Review</button>
        </form>
    </div>
@endsection
