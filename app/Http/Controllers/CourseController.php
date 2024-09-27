<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Fetch the courses the user is enrolled in using the relationship
        $enrolledCourses = $user->courses;

        // Pass the courses to the view
        return view('home', compact('enrolledCourses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($code)
    {
        // Find the course by its code
        $course = Course::where('code', $code)->firstOrFail();

        // Get teachers, students, and assessments
        $teachers = $course->teachers;
        $students = $course->students;
        $assessments = $course->assessments;

        return view('courses', compact('course', 'teachers', 'students', 'assessments'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
