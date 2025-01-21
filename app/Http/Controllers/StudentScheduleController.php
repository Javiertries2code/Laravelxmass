<?php

namespace App\Http\Controllers;
use App\Models\StudentSchedule;

use Illuminate\Http\Request;

class StudentScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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



     public function showOne($id){
        $schedule =  StudentSchedule::where('course_id', $id)->get();


        return view('student.scheduleCourse', ['schedules' => $schedule ]);


     }
    /**
     * Display the specified resource.
     */
    public function show()
    {
        $student_course = \App\Models\Registration::where('student_id', auth()->user()->id)->pluck('course_id')->toArray();
        $schedules =  StudentSchedule::whereIn('course_id', $student_course)->get()->groupBy('course_id');

    //    // dd($student_course);
    //    foreach($schedules as $course)
    //         echo $course; //esto ya es el id de course
        $subjects = \App\Models\Subject::all();
        $subject2 = \App\Models\Subject::find(2);
        $subject6 = \App\Models\Subject::find(6);

       return view('student.horarios', ['schedules' => $schedules, 'subjects' => $subjects, 'subject2' => $subject2, 'subject6' => $subject6 ]);


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
