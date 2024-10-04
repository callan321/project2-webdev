<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    // Show a form to manually enroll a student into a course
    public function create()
    {
        // Get all courses and students (assuming students are users with a specific role)
        $courses = Course::all();
        $students = User::where('role', 's')->get();

        return view('enrollments.create', compact('courses', 'students'));
    }
    // Store the enrollment in the database
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        // Create enrollment record
        Enrollment::create([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
        ]);

        return redirect()->back()->with('success', 'Student successfully enrolled in the course.');
    }
}
