<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Course;
use Illuminate\Http\Request;

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
        Assessment::create($request->all());

        // Redirect to the show page of the newly created assessment
        return redirect()->route('assessments.show', $assessment->id)
            ->with('success', 'Assessment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $assessment = Assessment::findOrFail($id);
        // Get the related course using the course_id
        $course = Course::findOrFail($assessment->course_id);

        // Return the view and pass the assessment and course to it
        return view('assessments.show', compact('assessment', 'course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $assessment = Assessment::findOrFail($id);
        $course = Course::findOrFail($assessment->course_id);

        // Pass the assessment and courses to the view
        return view('assessments.edit', compact('assessment', 'course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'instruction' => 'required|string',
            'max_score' => 'required|integer|min:1|max:100',
            'due_date' => 'required|date',
            'due_time' => 'required|date_format:H:i',
            'type' => 'required|in:student-select,teacher-assign',
        ]);

        // Find the assessment and update its details
        $assessment = Assessment::findOrFail($id);
        $assessment->update($request->all());

        return redirect()->route('courses.show', $assessment->course->code)
            ->with('success', 'Assessment updated successfully.');
    }


}
