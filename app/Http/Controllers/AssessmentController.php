<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function show($id)
    {
        // Find the assessment by ID or fail
        $assessment = Assessment::with('course')->findOrFail($id);


        return view('assessment', [
            'assessment' => $assessment,
            'course' => $assessment->course,
        ]);
    }
}
