<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\MeetingController;

use App\Http\Controllers\API\CourseController;

use App\Http\Controllers\API\RegistrationController;

use App\Http\Controllers\API\ScheduleController;

use App\Http\Controllers\API\StudentScheduleController;

use App\Http\Controllers\API\SubjectController;



Route::get('/api/users', [UserController::class, 'index'])->middleware(['can:admin', 'can:god']);
Route::get('/api/users/{user}', [UserController::class, 'show'])->middleware(['can:admin', 'can:god']);
Route::post('/api/users', [UserController::class, 'store'])->middleware(['can:admin', 'can:god']);
Route::put('/api/users/{user}', [UserController::class, 'update'])->middleware(['can:admin', 'can:god']);
Route::delete('/api/users/{user}', [UserController::class, 'destroy'])->middleware(['can:admin', 'can:god']);

Route::get('/api/courses', [CourseController::class, 'index'])->middleware(['can:todos']);
Route::get('/api/courses/{course}', [CourseController::class, 'show'])->middleware(['can:todos']);
Route::post('/api/courses', [CourseController::class, 'store'])->middleware(['can:admin', 'can:god']);
Route::put('/api/courses/{course}', [CourseController::class, 'update'])->middleware(['can:admin', 'can:god']);
Route::delete('/api/courses/{course}', [CourseController::class, 'destroy'])->middleware(['can:admin', 'can:god']);

Route::get('/api/subjects', [SubjectController::class, 'index'])->middleware(['can:todos']);
Route::get('/api/subjects/{subject}', [SubjectController::class, 'show'])->middleware(['can:todos']);
Route::post('/api/subjects', [SubjectController::class, 'store'])->middleware(['can:admin', 'can:god']);
Route::put('/api/subjects/{subject}', [SubjectController::class, 'update'])->middleware(['can:admin', 'can:god']);
Route::delete('/api/subjects/{subject}', [SubjectController::class, 'destroy'])->middleware(['can:admin', 'can:god']);


Route::get('/api/schedules', [ScheduleController::class, 'index'])->middleware(['can:admin', 'can:god', 'can:teacher']);
Route::get('/api/schedules/{schedule}', [ScheduleController::class, 'show'])->middleware(['can:admin', 'can:god', 'can:teacher']);
Route::post('/api/schedules', [ScheduleController::class, 'store'])->middleware(['can:admin', 'can:god']);
Route::put('/api/schedules/{schedule}', [ScheduleController::class, 'update'])->middleware(['can:admin', 'can:god']);
Route::delete('/api/schedules/{schedule}', [ScheduleController::class, 'destroy'])->middleware(['can:admin', 'can:god']);

Route::get('/api/studentschedules', [StudentScheduleController::class, 'index'])->middleware(['can:student']);
Route::get('/api/studentschedules/{studentschedule}', [StudentScheduleController::class, 'show'])->middleware(['can:student']);

Route::post('/api/studentschedules', [StudentScheduleController::class, 'store'])->middleware(['can:admin', 'can:god']);
Route::put('/api/studentschedules/{studentschedule}', [StudentScheduleController::class, 'update'])->middleware(['can:admin', 'can:god']);
Route::delete('/api/studentschedules/{studentschedule}', [StudentScheduleController::class, 'destroy'])->middleware(['can:admin', 'can:god']);

