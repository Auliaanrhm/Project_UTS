<?php

use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Route;


Route::apiResource('enrollments', EnrollmentController::class);
Route::get('enrollments/course/{course_id}/count', [EnrollmentController::class, 'countByCourse']);
Route::get('enrollments/student/{student_id}/count', [EnrollmentController::class, 'countByStudent']);
