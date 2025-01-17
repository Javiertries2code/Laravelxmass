<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Models\User;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meetings = Meeting::all();
        $headers = ['id', 'Dia', 'Hora', 'Profesor', 'Alumno', 'Email' ];

        // dd($meetings);
        return view('meeting.allmeetings', compact('meetings','headers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = User::where('user_type', 'teacher')->get();
        $authUser = auth()->user();

        return view('meeting.newmeeting', compact('teachers', 'authUser'));
    }

    /**
     * Show the meetings of the authenticated user.
     */
    public function mymeetings()
    {
        $meetings = Meeting::where('teacher_id', auth()->user()->id)
            ->orWhere('student_id', auth()->user()->id)
            ->get();
        return view('meeting.mymeetings', compact('meetings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $student = User::where('email', $request->alumno_email);
        $teacher = User::where('email', $request->teacher_email);



        if($teacher->count() == 0)
        {
            //dd($teacher);
            return back()->with('error', 'El profesor no existe');
        }

        $meeting = new Meeting();
        $meeting->day_week = $request->dia;
        $meeting->hour = $request->hora;
        $meeting->teacher_id = $teacher->first()->id;
        $meeting->student_id = $student->first()->id;
        //$meeting->publicado = $request->has('publicado');
        $meeting->save();
        return redirect()->route('meeting.mymeetings');
    }

    /**
     * Display the specified resource.
     */
    public function show(Meeting $meeting) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meeting $meeting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meeting $meeting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meeting $meeting)
    {
        //
    }
}
