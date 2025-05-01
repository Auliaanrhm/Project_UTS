<?php

namespace App\Http\Controllers;
use App\Models\Enrollment;
use Illuminate\Http\Request;

abstract class Controller
{
    public function index()
    {
        return Enrollment::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'  => 'required|integer',
            'course_id'   => 'required|integer',
            'enrolled_at' => 'required|date',
            'status'      => 'required|string',
        ]);
        return Enrollment::create($validated);
    }

    public function show($id)
    {
        return Enrollment::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->update($request->all());
        return $enrollment;
    }

    public function destroy($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
