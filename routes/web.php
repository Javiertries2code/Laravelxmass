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
// Route::get('/myhome', [App\Http\Controllers\HomeController::class, 'goHome'])->name('gohome');
Route::get('/', [App\Http\Controllers\HomeController::class, 'goHome'])->name('roothome');

Route::get('admin/adminhome', [App\Http\Controllers\AdminController::class, 'adminhome'])->name('admin.adminhome')->middleware('can:admin');

//admin role
Route::get('admin/listsUsers', [App\Http\Controllers\AdminController::class, 'listsUsers'])->name('admin.listsUsers')->middleware('can:admin');
Route::get('admin/createUser', [App\Http\Controllers\AdminController::class, 'createUser'])->name('admin.createUser')->middleware('can:admin');
Route::post('admin/storeNewUser', [App\Http\Controllers\AdminController::class, 'storeNewUser'])->name('admin.storeNewUser')->middleware('can:admin');
Route::get('admin/editUser/{id}', [AdminController::class, 'editUser'])->name('admin.editUser')->middleware('can:admin');
Route::put('/admin/updateUser/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser')->middleware('can:admin');
Route::delete('/admin/deleteUser/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser')->middleware('can:admin');

Route::delete('/admin/deleteStudent/{id}', [AdminController::class, 'deleteStudent'])->name('admin.deleteStudent')->middleware('can:admin');
Route::put('/admin/updateStudent/{id}', [AdminController::class, 'updateStudent'])->name('admin.updateStudent')->middleware('can:admin');
Route::get('admin/editStudent/{id}', [AdminController::class, 'editStudent'])->name('admin.editStudent')->middleware('can:admin');

Route::delete('/admin/deleteTeacher/{id}', [AdminController::class, 'deleteTeacher'])->name('admin.deleteTeacher')->middleware('can:admin');;


Route::get('admin/roles', [AdminController::class, 'showRoles'])->name('admin.roles')->middleware('can:admin');
Route::delete('admin/roles', [AdminController::class, 'roleDelete'])->name('admin.roledestroy')->middleware('can:admin');
Route::post('admin/rolcreate', [AdminController::class, 'storeRole'])->name('admin.rolcreate')->middleware('can:admin');

//
Route::delete('admin/courseDelete/{id}', [CourseController::class, 'courseDelete'])->name('course.courseDelete')->middleware('can:admin');
Route::post('admin/storeCourse', [CourseController::class, 'storeCourse'])->name('course.storeCourse')->middleware('can:admin');
Route::put('admin/updateCourse/{id}', [CourseController::class, 'updateCourse'])->name('course.updateCourse')->middleware('can:admin');
Route::get('admin/editCourse/{id}', [CourseController::class, 'editCourse'])->name('course.editCourse')->middleware('can:admin');
Route::get('admin/createCourse', [CourseController::class, 'createCourse'])->name('course.createCourse')->middleware('can:admin');

Route::post('admin/storeCoursewithsubject', [CourseController::class, 'storeCoursewithSubject'])->name('course.storeCoursewithsubject')->middleware('can:admin');
// Route::post('admin/storeCoursewithsubject', [CourseController::class, 'storeCoursewithSubject'])->name('course.storeCoursewithsubject')->middleware('can:admin');
// //

Route::get('course/coursesList', [CourseController::class, 'coursesList'])->name('course.coursesList')->middleware('can:student');

Route::get('subjects/subjectsList', [SubjectController::class, 'subjectsList'])->name('subjects.subjectsList')->middleware('can:teacher_student');
Route::delete('admin/subjectDelete/{id}', [SubjectController::class, 'subjectDelete'])->name('subject.subjectDelete')->middleware('can:admin');
Route::post('admin/storeSubject', [SubjectController::class, 'storeSubject'])->name('subject.storeSubject')->middleware('can:admin');
Route::put('admin/updateSubject/{id}', [SubjectController::class, 'updateSubject'])->name('subject.updateSubject')->middleware('can:admin');
Route::get('admin/editSubject/{id}', [SubjectController::class, 'editSubject'])->name('subject.editSubject')->middleware('can:admin');
Route::get('admin/createSubject', [SubjectController::class, 'createSubject'])->name('subject.createSubject')->middleware('can:admin');






Route::get('teacher/teacherhome', [App\Http\Controllers\AdminController::class, 'teacherhome'])->name('teacher.teacherhome')->middleware('can:teacher');



Route::get('admin/listsStudents', [App\Http\Controllers\AdminController::class, 'listsStudents'])->name('admin.listsStudents')->middleware('can:teacher');

Route::get('teacher/listsTeachers', [App\Http\Controllers\TeacherController::class, 'listsTeachers'])->name('teacher.listsTeachers')->middleware(['can:student']);


////anadidas mas tarde
Route::get('students/horarios', [App\Http\Controllers\StudentScheduleController::class, 'show'])->name('students.horarios')->middleware('can:student');

Route::get('students/horarios/{id}', [App\Http\Controllers\StudentScheduleController::class, 'showOne'])->name('students.ScheduleCourse')->middleware('can:student');


Route::get('/teacher/teachersSchedule', [App\Http\Controllers\TeacherController::class, 'teachersSchedule'])->name('teacher.teachersSchedule')->middleware('can:teacher');;


Route::get('/teacher/teachersList', [App\Http\Controllers\TeacherController::class, 'teachers'])->name('teachersList')->middleware('can:teacher');;

Route::get('/teacher/showOne/{teacher_id}', [App\Http\Controllers\TeacherController::class, 'showOne'])->name('showOneteacher')->middleware('can:teacher');


/// Routes mmeting
Route::get('/meeting/newmeeting', [App\Http\Controllers\MeetingController::class, 'create'])->name('newmeeting')->middleware(['can:teacher_student']);;
// esto aun no funcion, el middleware no deja borrar con 403. El middleware no parece funcionar bien
Route::delete('/meeting/deleteMeeting/{id}', [App\Http\Controllers\MeetingController::class, 'destroy'])->name('meeting.delete')->middleware(['can:teacher_student']);
Route::get('/meeting/editMeeting/{id}', [App\Http\Controllers\MeetingController::class, 'editMeeting'])->name('editMeeting')->middleware(['can:teacher_student']);
Route::put('/meeting/updateMeeting/{id}', [App\Http\Controllers\MeetingController::class, 'update'])->name('meeting.update')->middleware(['can:teacher_student']);
Route::post('/meeting/approveMeeting/{id}', [App\Http\Controllers\MeetingController::class, 'approveMeeting'])->name('meeting.approveMeeting')->middleware(['can:teacher']);


//Route::post('meetings.store', [App\Http\Controllers\MeetingController::class, 'store'])->name('meetings.store');

Route::post('meetings.store', [App\Http\Controllers\MeetingController::class, 'store'])->name('meetings.store')->middleware(['can:student']);
Route::get('/meeting/allmeetings', [App\Http\Controllers\MeetingController::class, 'index'])->name('meeting.index')->middleware(['can:admin']);
Route::get('/meeting/showOne/{meeting_id}', [App\Http\Controllers\MeetingController::class, 'showOne'])->name('showOne')->middleware(['can:teacher', 'can:student']);

Route::get('/meeting/mymeetings', [App\Http\Controllers\MeetingController::class, 'mymeetings'])->name('meeting.mymeetings')->middleware(['can:teacher_student']);;


Route::get('/student/studenthome', [App\Http\Controllers\StudentController::class, 'studenthome'])->name('studentHome')->middleware(['can:student']);

Route::get('/student/studentslist', [App\Http\Controllers\StudentController::class, 'studenListForCurrentTecher'])->name('student.studentslist')->middleware(['can:teacher']);


Route::get('/admin/registrationNew', [App\Http\Controllers\AdminController::class, 'registrationNew'])->name('admin.registrationNew')->middleware(['can:admin']);
Route::get('/admin/registrationList', [App\Http\Controllers\AdminController::class, 'registrationList'])->name('admin.registrationList')->middleware('can:admin');
Route::post('/admin/registrationStore', [App\Http\Controllers\AdminController::class, 'registrationStore'])->name('admin.registrationStore')->middleware('can:admin');
Route::post('/admin/registrationUpdate', [App\Http\Controllers\AdminController::class, 'registrationUpdate'])->name('admin.registrationUpdate')->middleware('can:admin');
Route::get('/admin/registrationList/{student_id}', [App\Http\Controllers\AdminController::class, 'registrationListByStudent'])->name('student.registrationListByStudent')->middleware(['can:student', 'can:teacher']);
Route::get('/admin/registrationEdit/{id}', [App\Http\Controllers\AdminController::class, 'registrationEdit'])->name('admin.registrationEdit')->middleware(['can:admin']);
Route::delete('/admin/registrationDelete/{id}', [App\Http\Controllers\AdminController::class, 'registrationDelete'])->name('admin.registrationDelete')->middleware(['can:admin']);
Auth::routes();
