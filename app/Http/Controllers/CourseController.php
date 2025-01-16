<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Subject;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function coursesList()
    {
        return $this->redirectCourses();

    }

    public function courseDelete(Request $request)
    {
        Course::where('id', $request->id)->delete();
        return $this->redirectCourses();
    }

    public function storeCourse(Request $request)
    {
        // Course::create(['name' => $request->name]);
        Course::create($request->all());
        return $this->redirectCourses();
    }
    public function storeCoursewitSubject(Request $request)
    {
        // Course::create(['name' => $request->name]);
        $course = [
            'name' => $request->name,
          ];
        $course = Course::create($course);

        $subjects = [
             $request->subject_1,
             $request->subject_2,
             $request->subject_3,
             $request->subject_4,
             $request->subject_5,
             $request->subject_6
        ];

        $course->subjects()->attach( $subjects);

        return $this->redirectCourses();
    }

    public function editCourse(String $id)
    {

        $course = Course::findOrFail($id);
        return view('courses.editCourse', compact('course'));

    }
    public function updateCourse(Request $request)
    {
        $course = Course::findOrFail($request->id);
        $course->update($request->all());
        return $this->redirectCourses();
    }

    public function createCourse()
    {
        $headers = [ 'Codigo','Nombre' ];
        $subjects = Subject::all();

        return view('courses.createCourse', compact( 'headers', 'subjects'));
    }



    private function redirectCourses()
    {
        $headers = ['id', 'name'];
        $courses = Course::all();
        return view('courses.coursesList', compact('courses', 'headers'));
    }

}
