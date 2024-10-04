@extends('layouts.authenticated')

@section('main')
    <div class="max-w-4xl mx-auto py-10 px-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-center">Upload Course File</h1>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- File Upload Form -->
        <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- File Input -->
            <div class="mb-6">
                <label for="file" class="block text-sm font-medium text-gray-700">Upload Course File (TXT)</label>
                <input type="file" name="file" id="file" class="mt-2 block w-full border border-gray-300 rounded" required>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-500">Upload</button>
            </div>
        </form>
    </div>
@endsection
