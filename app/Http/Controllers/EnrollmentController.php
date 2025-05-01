<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Http;

class EnrollmentController extends Controller
{
    public function index()
    {
        try {
            $courseResponse = Http::get('http://localhost:8081/api/courses');
            if ($courseResponse->failed()) {
                return response()->json(['error' => 'Failed to fetch courses'], 500);
            }
            $courses = collect($courseResponse->json());

            $studentResponse = Http::get('http://localhost:8082/api/students');
            if ($studentResponse->failed()) {
                return response()->json(['error' => 'Failed to fetch students'], 500);
            }
            $students = collect($studentResponse->json());

            $enrollments = Enrollment::all();

            $result = $enrollments->map(function ($enrollment) use ($courses, $students) {
                $course = $courses->firstWhere('id', $enrollment->course_id);
                $student = $students->firstWhere('id', $enrollment->student_id);

                return [
                    'id' => $enrollment->id,
                    'enrolled_at' => $enrollment->enrolled_at,
                    'course' => $course ?? 'Course not found',
                    'student' => $student ?? 'Student not found',
                ];
            });

            return response()->json($result, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed to add new enrollment.'
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'student_id'  => 'required|integer',
                'course_id'   => 'required|integer',
                'enrolled_at' => 'required|date',
                'status'      => 'required|string',
            ]);
            $enrollment = Enrollment::create($validated);

            return response()->json($enrollment, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => true,
                'message' => $e->validator->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed to add new enrollment.'
            ], 500);
        }
    }

    public function show($id)
    {
        $enrollment = Enrollment::find($id);
        if (!$enrollment) {
            return response()->json(['error' => 'Data not found'], 404);
        }
        return response()->json($enrollment, 200);
    }

    public function update(Request $request, $id)
    {
        try {
            $enrollment = Enrollment::findOrFail($id);
            $enrollment->update($request->all());
            return $enrollment;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => true,
                'message' => 'Data not found.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'An error occurred while fetching enrollments.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $enrollment = Enrollment::findOrFail($id);
            $enrollment->delete();
            return response()->json([
                'message' => 'Enrollment deleted successfully.',
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => true,
                'message' => 'Data not found.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'An error occurred while deleting enrollment.',
            ], 500);
        }
    }

    public function countByCourse($course_id)
    {
        $count = Enrollment::where('course_id', $course_id)->count();

        return response()->json([
            'course_id' => $course_id,
            'student_count' => $count
        ]);
    }

    public function countByStudent($student_id)
    {
        $count = Enrollment::where('course_id', $student_id)->count();

        return response()->json([
            'student_id' => $student_id,
            'enrolled_course_count' => $count
        ]);
    }
}
