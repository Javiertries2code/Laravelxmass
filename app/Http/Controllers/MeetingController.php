<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentPage = request()->query('page', 1);
        $data = Meeting::paginate(config('app.pagination_count'), ['*'], 'page', $currentPage);
        foreach ($data as $meeting) {
            $meeting->teacher_name_str = User::find($meeting->teacher_id)->name;
            $meeting->student_name_str = User::find($meeting->student_id)->name;
            $meeting->hora_str = 'Hora ' . $meeting->hour;
        }
        $headers = [
            'id' => 'id',
            'day_week' => 'Dia',
            'hora_str' => 'Hora',
            'teacher_name_str' => 'Profesor',
            'student_name_str' => 'Alumno',
        ];
        $actions = [
            'delete' => 'meeting.delete',
            'edit' => 'editMeeting',
        ];

        $title = 'Listado de Reuniones';

        return view('admin.listTableData', compact('title', 'data', 'headers', 'actions'));
    }



    // carga la vista de editar un meeting form
    public function editMeeting(string $id)
    {
        $meeting = Meeting::find($id);
        $teachers = User::where('user_type', 'teacher')->get();
        $students = User::where('user_type', 'student')->get();

        return view('meeting.editMeeting', compact('meeting', 'teachers', 'students'));
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
        if (!Auth::check()) {
            $data = [];
        } else {

            $userid = Auth::user()->id;

            $currentPage = request()->query('page', 1);
            $data = Meeting::where('teacher_id', $userid)
                ->orWhere('student_id', $userid)->paginate(config('app.pagination_count'), ['*'], 'page', $currentPage);
            foreach ($data as $meeting) {
                $meeting->teacher_name_str = User::find($meeting->teacher_id)->name;
                $meeting->student_name_str = User::find($meeting->student_id)->name;
                $meeting->hora_str = 'Hora ' . $meeting->hour;

                $meeting->accepted = $meeting->accepted ? '<span class="text-success">Aprobado</span>' : '<span class="text-warning">Pendiente</span>';
            }
            $headers = [
                'id' => 'id',
                'day_week' => 'Dia',
                'hora_str' => 'Hora',
                'teacher_name_str' => 'Profesor',
                'student_name_str' => 'Alumno',
                'accepted' => 'Estado',
            ];

            if (Auth::user()->can('teacher')) {
                $actions = [
                    'delete' => 'meeting.delete',
                    'edit' => 'editMeeting',
                ];
            } elseif (Auth::user()->can('student') ) {
                $actions = [
                    'delete' => 'meeting.delete',
                ];
            }else {
                $actions = [];
            }

            $title = 'Listado de Reuniones';
        }
        return view('admin.listTableData', compact('title', 'data', 'headers', 'actions'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $student = User::where('email', $request->alumno_email);
        $teacher = User::where('email', $request->teacher_email);



        if ($teacher->count() == 0) {
            //dd($teacher);
            return back()->with('error', 'El profesor no existe');
        }

        $meeting = new Meeting();
        $meeting->day_week = $request->dia;
        $meeting->hour = $request->hour;
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
        $meeting = Meeting::find($request->id);
        $meeting->day_week = $request->input('dia');
        $meeting->hora = $request->input('hora');
        $meeting->teacher_id = $request->input('teacher_id');
        $meeting->student_id = $request->input('student_id');
        $meeting->save();
        return redirect()->route('admin.meetings.index');
    }


    public function approveMeeting(Request $request, Meeting $meeting)
    {
        $meeting = Meeting::find($request->id);
        $meeting->accepted = $request->input('accepted') == '1';
        $meeting->save();
        return back()->with('success', 'Meeting actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Meeting $meeting)
    {
        // refinar las capacidades de borrar. Solo puede borrar el student que este
        // referenciado en el meeting. Lo mismo con teacher
        $meeting = Meeting::find($request->id);

        $student_permiso = auth()->user()->can('student') && auth()->user()->id == $meeting->student_id;
        $teacher_permiso = (auth()->user()->can('teacher') && auth()->user()->id == $meeting->teacher_id);
        if (
            auth()->user()->can('admin') || $student_permiso || $teacher_permiso
        ) {
            $meeting->delete();
            return redirect()->route('meeting.mymeetings')->with('success', 'Reunion borrada correctamente para profesor ' . $meeting->teacher_id . ' y alumno ' . $meeting->student_id);
        } else {
            abort(403, 'No tienes permiso para borrar esta reunion, ' .
                auth()->user()->id . $student_permiso);
        }

        return redirect()->route('meeting.mymeetings');
    }
}
