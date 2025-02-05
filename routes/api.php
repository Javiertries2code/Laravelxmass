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





Route::get('/users', [UserController::class, 'index'])->middleware(['can:admin', 'can:god']);
Route::get('/users/{user}', [UserController::class, 'show'])->middleware(['can:admin', 'can:god']);
Route::post('/users', [UserController::class, 'store'])->middleware(['can:admin', 'can:god']);
Route::put('/users/{user}', [UserController::class, 'update'])->middleware(['can:admin', 'can:god']);
Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware(['can:admin', 'can:god']);

Route::get('/courses', [CourseController::class, 'index'])->middleware(['can:todos']);
Route::get('/courses/{course}', [CourseController::class, 'show'])->middleware(['can:todos']);
Route::post('/courses', [CourseController::class, 'store'])->middleware(['can:admin', 'can:god']);
Route::put('/courses/{course}', [CourseController::class, 'update'])->middleware(['can:admin', 'can:god']);
Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->middleware(['can:admin', 'can:god']);

Route::get('/subjects', [SubjectController::class, 'index'])->middleware(['can:todos']);
Route::get('/subjects/{subject}', [SubjectController::class, 'show'])->middleware(['can:todos']);
Route::post('/subjects', [SubjectController::class, 'store'])->middleware(['can:admin', 'can:god']);
Route::put('/subjects/{subject}', [SubjectController::class, 'update'])->middleware(['can:admin', 'can:god']);
Route::delete('/subjects/{subject}', [SubjectController::class, 'destroy'])->middleware(['can:admin', 'can:god']);

Route::get('/schedules', [ScheduleController::class, 'index'])->middleware(['can:admin', 'can:god', 'can:teacher']);
Route::get('/schedules/{schedule}', [ScheduleController::class, 'show'])->middleware(['can:admin', 'can:god', 'can:teacher']);
Route::post('/schedules', [ScheduleController::class, 'store'])->middleware(['can:admin', 'can:god']);
Route::put('/schedules/{schedule}', [ScheduleController::class, 'update'])->middleware(['can:admin', 'can:god']);
Route::delete('/schedules/{schedule}', [ScheduleController::class, 'destroy'])->middleware(['can:admin', 'can:god']);

Route::get('/studentschedules', [StudentScheduleController::class, 'index'])->middleware(['can:student']);
Route::get('/studentschedules/{studentschedule}', [StudentScheduleController::class, 'show'])->middleware(['can:student']);
Route::post('/studentschedules', [StudentScheduleController::class, 'store'])->middleware(['can:admin', 'can:god']);
Route::put('/studentschedules/{studentschedule}', [StudentScheduleController::class, 'update'])->middleware(['can:admin', 'can:god']);
Route::delete('/studentschedules/{studentschedule}', [StudentScheduleController::class, 'destroy'])->middleware(['can:admin', 'can:god']);

