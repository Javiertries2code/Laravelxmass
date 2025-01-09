<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/students', function () {
   // return view('welcome');
   echo "calling students route";
});


 Route::get('/students/horarios', [App\Http\Controllers\StudentScheduleController::class, 'show'])->name('horarios');



 Route::get('/teacher/teachersList', [App\Http\Controllers\TeacherController::class, 'teachers'])->name('teachersList');

 Route::get('/teacher/showOne/{teacher_id}', [App\Http\Controllers\TeacherController::class, 'showOne'])->name('showOne');



 