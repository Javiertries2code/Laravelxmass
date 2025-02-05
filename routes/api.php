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


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiresources([
    'courses' => CourseController::class,
]);
