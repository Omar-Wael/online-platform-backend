<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Requests\CourseRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('lessons', 'instructor')->get();
        Log::info('index', [$courses]);
        return response()->json($courses);
    }

    public function store(CourseRequest $request)
    {
        $validated = $request->validated();

        $course = Course::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'instructor_id' => Auth::id(),
        ]);
        Log::info($course);
        return response()->json([
            'message' => 'Course created successfully',
            'course' => $course,
        ], 201);
    }

    public function show($id)
    {
        $course = Course::with('lessons', 'instructor')->findOrFail($id);
        return response()->json($course);
    }

    public function update(CourseRequest $request, $id)
    {
        $validated = $request->validated();

        $course = Course::findOrFail($id);

        if ($course->instructor_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $course->update($validated);

        return response()->json(['message' => 'Course updated successfully', 'course' => $course]);
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        if ($course->instructor_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $course->delete();

        return response()->json(['message' => 'Course deleted successfully']);
    }
}