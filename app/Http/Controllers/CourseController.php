<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Http;

class CourseController extends Controller
{
    public function index()
    {
        return Course::all();
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title'       => 'required',
                'description' => 'required',
                'instructor'  => 'required',
                'duration'    => 'required|integer',
                'price'       => 'required|numeric',
            ]);
            $course = Course::create($validated);

            return response()->json($course, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => true,
                'message' => $e->validator->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed to create student.'
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $course = Course::find($id);

            if (!$course) {
                return response()->json(['error' => 'Course not found'], 404);
            }

            $response = Http::get("http://localhost:8080/api/enrollments/course/{$id}/count");

            if ($response->failed()) {
                return response()->json(['error' => 'Failed to fetch enrollment count'], 500);
            }

            $studentCount = $response->json()['student_count'];

            $result = [
                'id' => $course->id,
                'title' => $course->title,
                'description' => $course->description,
                'instructor' => $course->instructor,
                'duration' => $course->duration,
                'price' => $course->price,
                'student_count' => $studentCount
            ];

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $course = Course::findOrFail($id);
            $course->update($request->all());
            return $course;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => true,
                'message' => 'Course not found.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'An error occurred while fetching courses.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $course = Course::findOrFail($id);
            $course->delete();
            return response()->json([
                'message' => 'Course deleted successfully.',
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => true,
                'message' => 'Course not found.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'An error occurred while deleting course.',
            ], 500);
        }
    }
}
