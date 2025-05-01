<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::apiResource('students', StudentController::class);
Route::get('/students/enrollment/{student_id}', [StudentController::class, 'studentEnrollments']);
