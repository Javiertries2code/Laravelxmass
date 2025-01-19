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
        return redirect()->route('course.coursesList')->with('success', 'El curso ha sido eliminado correctamente.');
    }

    public function storeCourse(Request $request)
    {
        // Course::create(['name' => $request->name]);

        Course::create($request->all());
        return redirect()->route('course.coursesList')->with('success', 'El curso ha sido guardado exitosamente.');
    }
    public function storeCoursewithSubject(Request $request)
    {
        // Course::create(['name' => $request->name]);
        $course = [
            'name' => $request->name,
            'code'=> $request->code,
          ];
        $course = Course::create($course);

        $subjects = [
             $request->subject1,
             $request->subject2,
             $request->subject3,
             $request->subject4,
             $request->subject5,
             $request->subject6
        ];

        $course->subjects()->attach($subjects);

        return redirect()->route('course.coursesList')->with('success', 'El curso ha sido guardado correctamente.');
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
        return redirect()->route('course.coursesList')->with('success', 'El curso ha sido guardado correctamente.');
    }

    public function createCourse()
    {
        $headers = [ 'Codigo','Nombre' ];
        $subjects = Subject::all();
        return view('courses.createCourse', compact( 'headers', 'subjects'));
    }




    private function redirectCourses()
    {
        $headers = ['id', 'Nombre', 'Asignaturas del Curso'];
        $courses = Course::all()->load('subjects');
        return view('courses.coursesList', compact('courses', 'headers'));
    }

}
