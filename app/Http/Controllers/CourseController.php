<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

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


    private function redirectCourses()
    {
        $headers = ['id', 'name', 'description'];
        $courses = Course::all();
        return view('courses.coursesList', compact('courses', 'headers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
