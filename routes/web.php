<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Using resources to create Routes


// Route::resources([
//     'courses' => CourseController::class,
//     ]);
//     Route::resources([
//         'registrations' => RegistrationController::class,
//         ]);
//         Route::resources([
//             'subjects' => SubjectController::class,
//             ]);
//             Route::resources([
//                 'meetings' => MeetingController::class,
//                 ]);
//                 Route::resources([
//                     'schedules' => ScheduleController::class,
//                     ]);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->withoutMiddleware(['auth']);

Route::get('/students', function () {
   // return view('welcome');
   echo "calling students route";
});


Route::get('students/horarios', [App\Http\Controllers\StudentScheduleController::class, 'show'])->name('students.horarios');

//Techars routes
Route::get('/teacher/horario', [App\Http\Controllers\TeacherController::class, 'teachers'])->name('teacherHoraio');


 Route::get('/teacher/teachersList', [App\Http\Controllers\TeacherController::class, 'teachers'])->name('teachersList');

 Route::get('/teacher/showOne/{teacher_id}', [App\Http\Controllers\TeacherController::class, 'showOne'])->name('showOne');


/// Routes mmeting
Route::get('/meeting/newmeeting', [App\Http\Controllers\MeetingController::class, 'create'])->name('newmeeting');

Route::post('meetings.store', [App\Http\Controllers\MeetingController::class, 'store'])->name('meetings.store');


Route::get('/meeting/allmeetings', [App\Http\Controllers\MeetingController::class, 'index'])->name('meeting.index');


Route::get('/meeting/showOne/{meeting_id}', [App\Http\Controllers\MeetingController::class, 'showOne'])->name('showOne');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
