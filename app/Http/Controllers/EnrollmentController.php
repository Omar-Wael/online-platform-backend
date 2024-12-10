<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;
use App\Models\Course;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::where('user_id', Auth::id())->with('course')->get();
        return response()->json($enrollments);
    }

    public function enroll($courseId)
    {
        $course = Course::findOrFail($courseId);

        if (Enrollment::where('user_id', Auth::id())->where('course_id', $course->id)->exists()) {
            return response()->json(['error' => 'Already enrolled'], 400);
        }

        $enrollment = Enrollment::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
            'progress' => 0,
        ]);

        return response()->json([
            'message' => 'Enrollment successful',
            'enrollment' => $enrollment,
        ], 201);
    }

    public function progress($courseId)
    {
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $courseId)
            ->firstOrFail();

        return response()->json($enrollment);
    }
}