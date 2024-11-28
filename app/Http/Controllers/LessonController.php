<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Lesson;
use App\Http\Requests\LessonRequest;

class LessonController extends Controller
{
    public function store(LessonRequest $request, $courseId)
    {
        $course = Course::findOrFail($courseId);

        if ($course->instructor_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $lesson = $course->lessons()->create($request->validated());

        return response()->json([
            'message' => 'Lesson created successfully',
            'lesson' => $lesson,
        ], 201);
    }

    public function update(LessonRequest $request, $lessonId)
    {
        $lesson = Lesson::findOrFail($lessonId);
        $course = $lesson->course;

        if ($course->instructor_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $lesson->update($request->validated());

        return response()->json(['message' => 'Lesson updated successfully', 'lesson' => $lesson]);
    }

    public function destroy($lessonId)
    {
        $lesson = Lesson::findOrFail($lessonId);
        $course = $lesson->course;

        if ($course->instructor_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $lesson->delete();

        return response()->json(['message' => 'Lesson deleted successfully']);
    }
}
