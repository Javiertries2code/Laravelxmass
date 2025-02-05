<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::orderBy('created_at')->get();
    return response()->json(['courses'=>$courses])
        ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $course = Course::create($request->all());
    return response()->json(['course' => $course])
        ->setStatusCode(Response::HTTP_CREATED);
}


public function update(Request $request, Course $course)
{
    $course->update($request->all());
    return response()->json(['course' => $course])
        ->setStatusCode(Response::HTTP_OK);
}


public function destroy(Course $course)
{
    $course->delete();
    return response()->json(['message' => 'Course deleted'])
        ->setStatusCode(Response::HTTP_OK);
}



  
    public function show(Course $course)
    {
        return response()->json($course)->setStatusCode(Response::HTTP_OK);

    }


}
