<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});





Auth::routes();

//meter aqui todas las rutas al crear toles****************************

// Route::prefix('admin')->middleware(['role:admin'])->group(function () {
//     Route::resource('students', StudentController::class)->names('admin.students');
// });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->withoutMiddleware(['auth']);



// Route::middleware(['role:admin'])->prefix('admin')->group(function () {

//     Route::get('adminhome', [App\Http\Controllers\AdminController::class, 'adminhome'])->name('admin.adminhome');
//     Route::get('listsStudents', [App\Http\Controllers\AdminController::class, 'listsStudents'])->name('admin.listsStudents');
//     Route::get('listsUsers', [App\Http\Controllers\AdminController::class, 'listsUsers'])->name('admin.listsUsers');
//     Route::post('storeNewUser', [App\Http\Controllers\AdminController::class, 'storeNewUser'])->name('admin.storeNewUser');
//     Route::get('createUser', [App\Http\Controllers\AdminController::class, 'createUser'])->name('admin.createUser');
//     Route::delete('/deleteUser/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
//     Route::delete('/deleteStudent/{id}', [AdminController::class, 'deleteStudent'])->name('admin.deleteStudent');
//     Route::put('/updateStudent/{id}', [AdminController::class, 'updateStudent'])->name('admin.updateStudent');
//     Route::put('/updateUser/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
//     Route::get('editStudent/{id}', [AdminController::class, 'editStudent'])->name('admin.editStudent');
//     Route::get('editUser/{id}', [AdminController::class, 'editUser'])->name('admin.editUser');

// });






Route::get('student/studenthome', [App\Http\Controllers\AdminController::class, 'studenthome'])->name('student.studenthome');
Route::get('teacher/teacherhome', [App\Http\Controllers\AdminController::class, 'teacherhome'])->name('teacher.teacherhome');
Route::get('admin/adminhome', [App\Http\Controllers\AdminController::class, 'adminhome'])->name('admin.adminhome');
Route::post('admin/storeNewUser', [App\Http\Controllers\AdminController::class, 'storeNewUser'])->name('admin.storeNewUser');
Route::get('admin/createUser', [App\Http\Controllers\AdminController::class, 'createUser'])->name('admin.createUser');
Route::get('admin/listsStudents', [App\Http\Controllers\AdminController::class, 'listsStudents'])->name('admin.listsStudents');
Route::get('admin/listsUsers', [App\Http\Controllers\AdminController::class, 'listsUsers'])->name('admin.listsUsers');
Route::delete('/admin/deleteUser/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
Route::delete('/admin/deleteStudent/{id}', [AdminController::class, 'deleteStudent'])->name('admin.deleteStudent');
Route::put('/admin/updateStudent/{id}', [AdminController::class, 'updateStudent'])->name('admin.updateStudent');
Route::put('/admin/updateUser/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
Route::get('admin/editStudent/{id}', [AdminController::class, 'editStudent'])->name('admin.editStudent');
Route::get('admin/editUser/{id}', [AdminController::class, 'editUser'])->name('admin.editUser');

////anadidas mas tarde
Route::get('admin/roles', [AdminController::class, 'showRoles'])->name('admin.roles');
Route::delete('admin/roles', [AdminController::class, 'roleDelete'])->name('admin.roledestroy');

Route::post('admin/rolcreate', [AdminController::class, 'storeRole'])->name('admin.rolcreate');



Route::get('students/horarios', [App\Http\Controllers\StudentScheduleController::class, 'show'])->name('students.horarios');





//Techars routes
Route::get('/teacher/horario', [App\Http\Controllers\TeacherController::class, 'teachers'])->name('teacherHoraio');


 Route::get('/teacher/teachersList', [App\Http\Controllers\TeacherController::class, 'teachers'])->name('teachersList');

 Route::get('/teacher/showOne/{teacher_id}', [App\Http\Controllers\TeacherController::class, 'showOne'])->name('showOneteacher');


/// Routes mmeting
Route::get('/meeting/newmeeting', [App\Http\Controllers\MeetingController::class, 'create'])->name('newmeeting');

Route::post('meetings.store', [App\Http\Controllers\MeetingController::class, 'store'])->name('meetings.store');


Route::get('/meeting/allmeetings', [App\Http\Controllers\MeetingController::class, 'index'])->name('meeting.index');


Route::get('/meeting/showOne/{meeting_id}', [App\Http\Controllers\MeetingController::class, 'showOne'])->name('showOne');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
