<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Http;

class StudentController extends Controller
{
    public function index()
    {
        return Student::all();
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'  => 'required',
                'email' => 'required|email|unique:students',
                'phone' => 'nullable',
            ]);

            $student = Student::create($validated);

            return response()->json($student, 201);
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
            $student = Student::find($id);
            if (!$student) {
                return response()->json(['error' => 'Student not found'], 404);
            } else {
                $response = Http::get("http://localhost:8080/api/enrollments/student/{$id}/count");

                if ($response->failed()) {
                    return response()->json(['error' => 'Failed to fetch enrollment count'], 500);
                }
    
                $courseCount = $response->json()['enrolled_course_count'];
    
                $result = [
                    'id' => $student->id,
                    'name' => $student->name,
                    'email' => $student->email,
                    'phone' => $student->phone,
                    'enrollment_count' => $courseCount,
                ];
                return response()->json($result, 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->update($request->all());
            return $student;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => true,
                'message' => 'Student not found.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'An error occurred while fetching students.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->delete();
            return response()->json([
                'message' => 'Student deleted successfully.',
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => true,
                'message' => 'Student not found.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'An error occurred while deleting student.',
            ], 500);
        }
    }

    public function studentEnrollments($student_id)
    {
        try {
            $student = Student::findOrFail($student_id);

            $response = Http::get('http://localhost:8080/api/enrollments');
            $enrollments = $response->json();

            $studentCourses = collect($enrollments)->where('student_id', $student->id)->values();
            $result = [
                'id' => $student->id,
                'name' => $student->name,
                'email' => $student->email,
                'phone' => $student->phone,
                'enrollments' => $studentCourses,
            ];

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'error' => $e->getMessage()
            ], 404);
        }
    }
}
