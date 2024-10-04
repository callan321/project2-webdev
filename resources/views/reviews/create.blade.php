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

            <!-- Structured Questions for the Review -->
            <div class="mb-4">
                <label for="reviewee_id" class="block font-medium">Select a Student to Review</label>
                <select name="reviewee_id" class="block w-full" required>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Structured Questions for Review -->
            <div class="mb-4">
                <label class="block font-medium">1. Code Quality</label>
                <textarea name="code_quality" rows="3" class="block w-full" required>{{ old('code_quality') }}</textarea>
                <small class="text-gray-600">How well is the code written in terms of functionality, logic, and meeting the task requirements?</small>
            </div>

            <div class="mb-4">
                <label class="block font-medium">2. Code Structure</label>
                <textarea name="code_structure" rows="3" class="block w-full" required>{{ old('code_structure') }}</textarea>
                <small class="text-gray-600">Is the code well-structured and easy to understand? Are the functions and modules logically organized?</small>
            </div>

            <div class="mb-4">
                <label class="block font-medium">3. Coding Style</label>
                <textarea name="coding_style" rows="3" class="block w-full" required>{{ old('coding_style') }}</textarea>
                <small class="text-gray-600">Does the code follow best practices and coding standards? (e.g., proper naming conventions, indentation, and comments)</small>
            </div>

            <div class="mb-4">
                <label class="block font-medium">4. Testing & Debugging</label>
                <textarea name="testing_debugging" rows="3" class="block w-full" required>{{ old('testing_debugging') }}</textarea>
                <small class="text-gray-600">Was the code adequately tested? Did the code handle edge cases and errors properly?</small>
            </div>

            <div class="mb-4">
                <label class="block font-medium">5. Documentation</label>
                <textarea name="documentation" rows="3" class="block w-full" required>{{ old('documentation') }}</textarea>
                <small class="text-gray-600">Is there sufficient documentation, such as comments in the code or a README file, to explain how the code works?</small>
            </div>

            <div class="mb-4">
                <label class="block font-medium">6. Areas for Improvement</label>
                <textarea name="areas_for_improvement" rows="3" class="block w-full" required>{{ old('areas_for_improvement') }}</textarea>
                <small class="text-gray-600">What areas can be improved in the code? Are there any bugs or inefficiencies?</small>
            </div>

            <div class="mb-4">
                <label class="block font-medium">7. General Feedback</label>
                <textarea name="general_feedback" rows="3" class="block w-full">{{ old('general_feedback') }}</textarea>
                <small class="text-gray-600">Any other feedback or additional comments on the project?</small>
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
