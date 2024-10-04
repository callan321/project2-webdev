@extends('layouts.authenticated')

@section('main')
    <div class="max-w-4xl mx-auto py-10">
        <h1 class="text-3xl font-bold mb-6">Marking for {{ $assessment->name }}</h1>

        <table class="w-full table-auto">
            <thead>
            <tr>
                <th class="px-4 py-2">Student Name</th>
                <th class="px-4 py-2">Reviews Submitted</th>
                <th class="px-4 py-2">Reviews Received</th>
            </tr>
            </thead>
            <tbody>
            @foreach($students as $student)
                <tr>
                    <td class="border px-4 py-2">{{ $student->name }}</td>
                    <td class="border px-4 py-2">{{ $student->submitted_reviews_count }}</td>
                    <td class="border px-4 py-2">{{ $student->received_reviews_count }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        {{ $students->links() }}
    </div>
@endsection
