<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Display form for submitting peer reviews
    public function create($assessmentId, $revieweeId = null)
    {
        $assessment = Assessment::findOrFail($assessmentId);
        $course = $assessment->course;
        $authUser = auth()->user();

        // If the user is a teacher, reviewee_id will be passed directly, so we fetch the reviewee
        if ($authUser->role === 't' && $revieweeId) {
            $reviewee = User::findOrFail($revieweeId);
            return view('reviews.create', compact('assessment', 'reviewee'));
        }

        // For students, we allow them to select a reviewee
        $students = $course->students->except($authUser->id); // Exclude the current student
        return view('reviews.create', compact('assessment', 'students'));
    }

    // Handle review submission
    public function store(Request $request, $assessmentId)
    {
        $authUser = auth()->user(); // The logged-in user (teacher or student)
        $assessment = Assessment::findOrFail($assessmentId); // Fetch the assessment to get max_score

        // Validation rules
        $rules = [
            'reviewee_id' => 'required|exists:users,id',
            'review_text' => 'required|min:5',
        ];

        // If the user is a teacher, they must provide a score
        if ($authUser->role === 't') {
            $rules['score'] = 'required|integer|min:0|max:' . $assessment->max_score; // Teachers must provide a score within max_score
        }

        // Validate the input
        $request->validate($rules);

        // Ensure the reviewer hasn't already reviewed this reviewee for this assessment
        $existingReview = Review::where('reviewer_id', $authUser->id)
            ->where('reviewee_id', $request->reviewee_id)
            ->where('assessment_id', $assessmentId)
            ->first();

        if ($existingReview) {
            return back()->withErrors(['error' => 'You have already reviewed this student.']);
        }

        // Save the review (include score if the reviewer is a teacher)
        Review::create([
            'reviewer_id' => $authUser->id,
            'reviewee_id' => $request->reviewee_id,
            'assessment_id' => $assessmentId,
            'review_text' => $request->review_text,
            'score' => $authUser->role === 't' ? $request->score : null, // Only store score if the user is a teacher
        ]);

        return redirect()->route('assessments.show', $assessmentId)->with('success', 'Review submitted successfully!');
    }

    // Marking page for teachers
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
        ])->paginate(10);

        return view('reviews.marking', compact('assessment', 'students'));
    }
}
