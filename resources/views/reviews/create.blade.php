@extends('layouts.authenticated')

@section('main')
    <div class="max-w-4xl mx-auto py-10 px-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold mb-6 text-center">Submit Review for {{ $assessment->name }}</h1>

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

            <!-- Select Student to Review -->
            <div class="mb-6">
                <label for="reviewee_id" class="block text-sm font-medium text-gray-700">Select a Student to Review</label>
                <select name="reviewee_id" id="reviewee_id" class="block w-full mt-2 rounded-md border border-gray-300 shadow-sm focus:ring-gray-900 focus:border-gray-900" required>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Structured Questions for the Review -->
            <div class="mb-6">
                <label for="code_quality" class="block text-sm font-medium text-gray-700">1. Code Quality</label>
                <textarea name="code_quality" id="code_quality" rows="3" class="block w-full mt-2 rounded-md border border-gray-300 shadow-sm focus:ring-gray-900 focus:border-gray-900" required>{{ old('code_quality') }}</textarea>
                <small class="text-gray-500">How well is the code written in terms of functionality, logic, and meeting the task requirements?</small>
            </div>

            <div class="mb-6">
                <label for="code_structure" class="block text-sm font-medium text-gray-700">2. Code Structure</label>
                <textarea name="code_structure" id="code_structure" rows="3" class="block w-full mt-2 rounded-md border border-gray-300 shadow-sm focus:ring-gray-900 focus:border-gray-900" required>{{ old('code_structure') }}</textarea>
                <small class="text-gray-500">Is the code well-structured and easy to understand? Are the functions and modules logically organized?</small>
            </div>

            <div class="mb-6">
                <label for="coding_style" class="block text-sm font-medium text-gray-700">3. Coding Style</label>
                <textarea name="coding_style" id="coding_style" rows="3" class="block w-full mt-2 rounded-md border border-gray-300 shadow-sm focus:ring-gray-900 focus:border-gray-900" required>{{ old('coding_style') }}</textarea>
                <small class="text-gray-500">Does the code follow best practices and coding standards? (e.g., proper naming conventions, indentation, and comments)</small>
            </div>

            <div class="mb-6">
                <label for="testing_debugging" class="block text-sm font-medium text-gray-700">4. Testing & Debugging</label>
                <textarea name="testing_debugging" id="testing_debugging" rows="3" class="block w-full mt-2 rounded-md border border-gray-300 shadow-sm focus:ring-gray-900 focus:border-gray-900" required>{{ old('testing_debugging') }}</textarea>
                <small class="text-gray-500">Was the code adequately tested? Did the code handle edge cases and errors properly?</small>
            </div>

            <div class="mb-6">
                <label for="documentation" class="block text-sm font-medium text-gray-700">5. Documentation</label>
                <textarea name="documentation" id="documentation" rows="3" class="block w-full mt-2 rounded-md border border-gray-300 shadow-sm focus:ring-gray-900 focus:border-gray-900" required>{{ old('documentation') }}</textarea>
                <small class="text-gray-500">Is there sufficient documentation, such as comments in the code or a README file, to explain how the code works?</small>
            </div>

            <div class="mb-6">
                <label for="areas_for_improvement" class="block text-sm font-medium text-gray-700">6. Areas for Improvement</label>
                <textarea name="areas_for_improvement" id="areas_for_improvement" rows="3" class="block w-full mt-2 rounded-md border border-gray-300 shadow-sm focus:ring-gray-900 focus:border-gray-900" required>{{ old('areas_for_improvement') }}</textarea>
                <small class="text-gray-500">What areas can be improved in the code? Are there any bugs or inefficiencies?</small>
            </div>

            <div class="mb-6">
                <label for="general_feedback" class="block text-sm font-medium text-gray-700">7. General Feedback</label>
                <textarea name="general_feedback" id="general_feedback" rows="3" class="block w-full mt-2 rounded-md border border-gray-300 shadow-sm focus:ring-gray-900 focus:border-gray-900">{{ old('general_feedback') }}</textarea>
                <small class="text-gray-500">Any other feedback or additional comments on the project?</small>
            </div>

            <!-- Only show the score field for teachers -->
            @if (auth()->user()->role == 't')
                <div class="mb-6">
                    <label for="score" class="block text-sm font-medium text-gray-700">Score (out of {{ $assessment->max_score }})</label>
                    <input type="number" name="score" id="score" class="block w-full mt-2 rounded-md border border-gray-300 shadow-sm focus:ring-gray-900 focus:border-gray-900" min="0" max="{{ $assessment->max_score }}" value="{{ old('score') }}" required>
                </div>
            @endif

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-500">
                    Submit Review
                </button>
            </div>
        </form>
    </div>
@endsection
