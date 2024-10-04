<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;
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

        // Check if the user has the role of 'teacher' or 'student'
        if ($user->role == 't') {
            // Fetch the courses where the user is a teacher
            $enrolledCourses = $user->coursesTeaching;  // Assuming a relationship exists in the User model
        } else {
            // Fetch the courses where the user is a student
            $enrolledCourses = $user->courses;  // Assuming 'courses' is the relationship for students
        }

        // Pass the courses to the view
        return view('courses.index', compact('enrolledCourses'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the uploaded file and ensure the course code is exactly 8 characters
        $request->validate([
            'file' => 'required|file|mimes:txt|max:2048',  // Ensure it's a text file, with a max size of 2MB
        ]);

        // Read the uploaded file
        $file = $request->file('file');
        $fileContent = file($file->getRealPath());  // Read file line by line

        $courseData = [];
        $teachers = [];
        $assessments = [];
        $students = [];

        // Parse each line of the file
        foreach ($fileContent as $line) {
            $line = trim($line);

            if (str_starts_with($line, 'Course:')) {
                // Parse the course information
                $courseParts = explode(',', str_replace('Course:', '', $line));
                $courseData = [
                    'code' => trim($courseParts[0]),
                    'name' => trim($courseParts[1]),
                ];

                // Validate that course code is exactly 8 characters long
                if (strlen($courseData['code']) !== 8) {
                    return redirect()->back()->withErrors(['error' => 'Course code must be exactly 8 characters long.']);
                }
            } elseif (str_starts_with($line, 'Teacher:')) {
                // Parse the teacher user ID
                $teachers[] = (int)trim(str_replace('Teacher:', '', $line));
            } elseif (str_starts_with($line, 'Assessment:')) {
                // Parse the assessment details
                $assessmentParts = explode(',', str_replace('Assessment:', '', $line));
                $assessments[] = [
                    'name' => trim($assessmentParts[0]),
                    'instruction' => trim($assessmentParts[1]),
                    'number_of_reviews' => trim($assessmentParts[2]),
                    'max_score' => trim($assessmentParts[3]),
                    'due_date' => trim($assessmentParts[4]),
                    'due_time' => trim($assessmentParts[5]),
                    'type' => trim($assessmentParts[6]),
                ];
            } elseif (str_starts_with($line, 'Student:')) {
                // Parse the student user ID
                $students[] = (int)trim(str_replace('Student:', '', $line));
            }
        }

        // Check if the course already exists
        $existingCourse = Course::where('code', $courseData['code'])->first();
        if ($existingCourse) {
            return redirect()->back()->withErrors(['error' => 'Course with this code already exists.']);
        }

        // Create the course
        $course = Course::create([
            'code' => $courseData['code'],
            'name' => $courseData['name'],
        ]);

        // Validate and attach the existing teachers (by ID) to the course
        foreach ($teachers as $teacherId) {
            $teacher = User::find($teacherId);
            if (!$teacher || $teacher->role !== 't') {  // Validate teacher role
                return redirect()->back()->withErrors(['error' => "User with ID $teacherId is not a valid teacher."]);
            }
            $course->teachers()->attach($teacher->id);
        }

        // Add assessments to the course
        foreach ($assessments as $assessmentData) {
            $course->assessments()->create($assessmentData);
        }

        // Validate and enroll the existing students (by ID) in the course
        foreach ($students as $studentId) {
            $student = User::find($studentId);
            if (!$student || $student->role !== 's') {  // Validate student role
                return redirect()->back()->withErrors(['error' => "User with ID $studentId is not a valid student."]);
            }
            Enrollment::create([
                'user_id' => $student->id,
                'course_id' => $course->id,
            ]);
        }

        return redirect()->route('courses.show', $course->code)->with('success', 'Course created successfully!');
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

        return view('courses.show', compact('course', 'teachers', 'students', 'assessments'));
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
