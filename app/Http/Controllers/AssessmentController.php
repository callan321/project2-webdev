<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create($course_id)
    {
        // Find the course by ID
        $course = Course::findOrFail($course_id);

        // Return the view and pass the course to it
        return view('assessments.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'instruction' => 'required|string',
            'course_id' => 'required|exists:courses,id',
            'max_score' => 'required|integer|min:1|max:100',
            'due_date' => 'required|date',
            'due_time' => 'required|date_format:H:i',
            'type' => 'required|in:student-select,teacher-assign',
        ]);

        // Create a new assessment
        $assessment = Assessment::create($request->all());

        // Redirect to the show page of the newly created assessment
        return redirect()->route('assessments.show', $assessment->id)
            ->with('success', 'Assessment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get the assessment
        $assessment = Assessment::findOrFail($id);

        // Get the related course using the course_id
        $course = Course::findOrFail($assessment->course_id);

        // Get the current authenticated user
        $user = Auth::user();

        // Initialize received reviews variable
        $receivedReviews = [];

        // If the user is a student, retrieve the reviews they received for this assessment
        if ($user->role == 's') {
            $receivedReviews = $assessment->reviews()
                ->where('reviewee_id', $user->id)  // Filter reviews where the student is the reviewee
                ->with('reviewer')  // Eager load the reviewer's information
                ->get();
        }

        // Return the view and pass the assessment, course, and received reviews to it
        return view('assessments.show', compact('assessment', 'course', 'receivedReviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $assessment = Assessment::findOrFail($id);
        $course = Course::findOrFail($assessment->course_id);

        // Check if there are any reviews for this assessment
        if ($assessment->reviews()->exists()) {
            return redirect()->route('assessments.show', $assessment->id)
                ->withErrors(['error' => 'You cannot edit this assessment because reviews have already been submitted.']);
        }

        // If no reviews, show the edit form
        return view('assessments.edit', compact('assessment', 'course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $assessment = Assessment::findOrFail($id);

        // Check if there are any reviews for this assessment
        if ($assessment->reviews()->exists()) {
            return redirect()->route('assessments.show', $assessment->id)
                ->withErrors(['error' => 'You cannot update this assessment because reviews have already been submitted.']);
        }

        // Validate the input and update the assessment
        $request->validate([
            'name' => 'required|string|max:255',
            'instruction' => 'required|string',
            'max_score' => 'required|integer|min:1|max:100',
            'due_date' => 'required|date',
            'due_time' => 'required|date_format:H:i',
            'type' => 'required|in:student-select,teacher-assign',
        ]);

        $assessment->update($request->all());

        return redirect()->route('courses.show', $assessment->course->code)
            ->with('success', 'Assessment updated successfully.');
    }
}
