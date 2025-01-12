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

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $schedules =  StudentSchedule::all()->groupBy('course_id');
        foreach( $schedules as $schs)
        {
           foreach(  $schs as $sch)
           {

           echo "HORARIO--<br><br>";
           echo "curso--";
           echo $sch->course_id; echo "<br><br>";
           echo $sch->day_week; echo "<br><brhour subject>--\r\n";
           echo $sch->hour_1; echo "<br><brhour subject>--\r\n";
           echo $sch->hour_2;echo "<br><br>hour subject--\r\n";
           echo $sch->hour_3;echo "<br><br>hour subject--\r\n";
           echo $sch->hour_4;echo "<br><br>hour subject--";
           echo $sch->hour_5;echo "<br><br>hour subject--";
           echo $sch->hour_6 ;echo "<br><br>";
        }
       }

        // Aquí podrías obtener datos si fuera necesario
        //return view('student.horarios', ['schedules' => $schedules ]);
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
