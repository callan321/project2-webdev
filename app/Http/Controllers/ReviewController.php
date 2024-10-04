<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Display form for submitting peer reviews
    public function create($assessmentId)
    {
        $assessment = Assessment::findOrFail($assessmentId);
        $course = $assessment->course;
        $student = auth()->user();

        // Fetch students enrolled in the course for "student-select" type assessments
        $students = $course->students->except($student->id); // Exclude the current student from the list

        return view('reviews.create', compact('assessment', 'students', 'course'));
    }

    // Handle review submission
    public function store(Request $request, $assessmentId)
    {
        $student = auth()->user();
        $assessment = Assessment::findOrFail($assessmentId);

        // Validate input
        $request->validate([
            'reviewee_id' => 'required|exists:users,id',
            'review_text' => 'required|min:5',
        ]);

        // Ensure the student hasn't already reviewed this reviewee for this assessment
        $existingReview = Review::where('reviewer_id', $student->id)
            ->where('reviewee_id', $request->reviewee_id)
            ->where('assessment_id', $assessmentId)
            ->first();

        if ($existingReview) {
            return back()->withErrors(['error' => 'You have already reviewed this student.']);
        }

        // Save the review
        Review::create([
            'reviewer_id' => $student->id,
            'reviewee_id' => $request->reviewee_id,
            'assessment_id' => $assessmentId,
            'review_text' => $request->review_text,
        ]);

        return redirect()->route('assessments.show', $assessmentId)->with('success', 'Review submitted successfully!');
    }

    public function marking($assessmentId)
    {
        $assessment = Assessment::findOrFail($assessmentId);
        $course = $assessment->course;

        // Get all students with their review counts
        $students = $course->students()->withCount([
            'submittedReviews' => function ($query) use ($assessmentId) {
                $query->where('assessment_id', $assessmentId);
            },
            'receivedReviews' => function ($query) use ($assessmentId) {
                $query->where('assessment_id', $assessmentId);
            },
        ])->paginate(10); // Paginate 10 students per page

        return view('reviews.marking', compact('assessment', 'students'));
    }

}
