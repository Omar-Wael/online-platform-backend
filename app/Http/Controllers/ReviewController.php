<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\Course;

class ReviewController extends Controller
{
    public function store(Request $request, $courseId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $course = Course::findOrFail($courseId);

        if (!Auth::user()->enrollments()->where('course_id', $courseId)->exists()) {
            return response()->json(['error' => 'You must be enrolled to leave a review'], 403);
        }

        $review = Review::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'message' => 'Review submitted successfully',
            'review' => $review,
        ], 201);
    }
}
