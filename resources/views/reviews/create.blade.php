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

            <div class="mb-4">
                <label for="reviewee_id" class="block font-medium">Select a Student to Review</label>
                <select name="reviewee_id" class="block w-full" required>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="review_text" class="block font-medium">Write your review</label>
                <textarea name="review_text" rows="5" class="block w-full" required></textarea>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2">Submit Review</button>
        </form>
    </div>
@endsection
