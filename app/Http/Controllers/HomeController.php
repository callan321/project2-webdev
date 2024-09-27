<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        // Get the authenticated user
        $user = Auth::user();

        // Fetch the courses the user is enrolled in using the relationship
        $enrolledCourses = $user->courses;

        // Pass the courses to the view
        return view('home', compact('enrolledCourses'));
    }
}
