<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SubjectController;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->withoutMiddleware(['auth']);




Route::get('/myhome', [App\Http\Controllers\MyHomeController::class, 'goHome'])->name('gohome');
Route::get('/', [App\Http\Controllers\MyHomeController::class, 'goHome'])->name('home');

Route::get('admin/adminhome', [App\Http\Controllers\AdminController::class, 'adminhome'])->name('admin.adminhome')->middleware('can:admin');;

//admin role
Route::get('admin/listsUsers', [App\Http\Controllers\AdminController::class, 'listsUsers'])->name('admin.listsUsers')->middleware('can:admin');;
Route::get('admin/createUser', [App\Http\Controllers\AdminController::class, 'createUser'])->name('admin.createUser')->middleware('can:admin');;
Route::post('admin/storeNewUser', [App\Http\Controllers\AdminController::class, 'storeNewUser'])->name('admin.storeNewUser')->middleware('can:admin');;
Route::get('admin/editUser/{id}', [AdminController::class, 'editUser'])->name('admin.editUser')->middleware('can:admin');;
Route::put('/admin/updateUser/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser')->middleware('can:admin');
Route::delete('/admin/deleteUser/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser')->middleware('can:admin');;

Route::delete('/admin/deleteStudent/{id}', [AdminController::class, 'deleteStudent'])->name('admin.deleteStudent');
Route::put('/admin/updateStudent/{id}', [AdminController::class, 'updateStudent'])->name('admin.updateStudent');
Route::get('admin/editStudent/{id}', [AdminController::class, 'editStudent'])->name('admin.editStudent');

Route::delete('/admin/deleteTeacher/{id}', [AdminController::class, 'deleteTeacher'])->name('admin.deleteTeacher');


Route::get('admin/roles', [AdminController::class, 'showRoles'])->name('admin.roles')->middleware('can:admin');;
Route::delete('admin/roles', [AdminController::class, 'roleDelete'])->name('admin.roledestroy')->middleware('can:admin');;
Route::post('admin/rolcreate', [AdminController::class, 'storeRole'])->name('admin.rolcreate')->middleware('can:admin');;

//
Route::delete('admin/courseDelete/{id}', [CourseController::class, 'courseDelete'])->name('course.courseDelete')->middleware('can:admin');
Route::post('admin/storeCourse', [CourseController::class, 'storeCourse'])->name('course.storeCourse')->middleware('can:admin');
Route::put('admin/updateCourse/{id}', [CourseController::class, 'updateCourse'])->name('course.updateCourse')->middleware('can:admin');
Route::get('admin/editCourse/{id}', [CourseController::class, 'editCourse'])->name('course.editCourse')->middleware('can:admin');
Route::get('admin/createCourse', [CourseController::class, 'createCourse'])->name('course.createCourse')->middleware('can:admin');

Route::post('admin/storeCoursewithsubject', [CourseController::class, 'storeCoursewithSubject'])->name('course.storeCoursewithsubject')->middleware('can:admin');
// Route::post('admin/storeCoursewithsubject', [CourseController::class, 'storeCoursewithSubject'])->name('course.storeCoursewithsubject')->middleware('can:admin');
// //

Route::get('course/coursesList', [CourseController::class, 'coursesList'])->name('course.coursesList')->middleware('can:student');;

Route::get('subjects/subjectsList', [SubjectController::class, 'subjectsList'])->name('subjects.subjectsList');
Route::delete('admin/subjectDelete/{id}', [SubjectController::class, 'subjectDelete'])->name('subject.subjectDelete')->middleware('can:admin');
Route::post('admin/storeSubject', [SubjectController::class, 'storeSubject'])->name('subject.storeSubject')->middleware('can:admin');
Route::put('admin/updateSubject/{id}', [SubjectController::class, 'updateSubject'])->name('subject.updateSubject')->middleware('can:admin');
Route::get('admin/editSubject/{id}', [SubjectController::class, 'editSubject'])->name('subject.editSubject')->middleware('can:admin');
Route::get('admin/createSubject', [SubjectController::class, 'createSubject'])->name('subject.createSubject')->middleware('can:admin');






Route::get('teacher/teacherhome', [App\Http\Controllers\AdminController::class, 'teacherhome'])->name('teacher.teacherhome')->middleware('can:teacher');;
Route::get('admin/listsStudents', [App\Http\Controllers\AdminController::class, 'listsStudents'])->name('admin.listsStudents')->middleware('can:teacher');;
Route::get('teacher/listsTeachers', [App\Http\Controllers\TeacherController::class, 'listsTeachers'])->name('teacher.listsTeachers')->middleware(['can:teacher,can:admin']);;


////anadidas mas tarde
Route::get('students/horarios', [App\Http\Controllers\StudentScheduleController::class, 'show'])->name('students.horarios')->middleware('can:student');



Route::get('/teacher/horario', [App\Http\Controllers\TeacherController::class, 'teachers'])->name('teacherHoraio');


Route::get('/teacher/teachersList', [App\Http\Controllers\TeacherController::class, 'teachers'])->name('teachersList');

Route::get('/teacher/showOne/{teacher_id}', [App\Http\Controllers\TeacherController::class, 'showOne'])->name('showOneteacher');


/// Routes mmeting
Route::get('/meeting/newmeeting', [App\Http\Controllers\MeetingController::class, 'create'])->name('newmeeting');
Route::delete('/admin/deleteMeeting/{id}', [App\Http\Controllers\MeetingController::class, 'deleteMeeting'])->name('admin.deleteMeeting')->middleware(['can:admin']);;
//Route::post('meetings.store', [App\Http\Controllers\MeetingController::class, 'store'])->name('meetings.store');

Route::post('meetings.store', [App\Http\Controllers\MeetingController::class, 'store'])->name('meetings.store')->middleware(['can:student']);
Route::get('/meeting/allmeetings', [App\Http\Controllers\MeetingController::class, 'index'])->name('meeting.index')->middleware(['can:admin']);;
Route::get('/meeting/showOne/{meeting_id}', [App\Http\Controllers\MeetingController::class, 'showOne'])->name('showOne')->middleware(['can:teacher', 'can:student']);

Route::get('/meeting/mymeetings', [App\Http\Controllers\MeetingController::class, 'mymeetings'])->name('meeting.mymeetings');


Route::get('/student/studenthome', [App\Http\Controllers\AdminController::class, 'studentHome'])->name('studenthome');

Auth::routes();

Auth::routes();
