<?php

namespace App\Http\Controllers;

use App\Models\User;


use Illuminate\Http\Request;

class TeacherController extends Controller
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


    public function teachers()
    {
        $students = User::where('user_type', 'teacher')->get();
        $headers = ['id', 'Nombre', 'Apellido', 'Email', 'tipo de usuario', 'Telefono 1'];

        return view('teacher.teachersList', compact('students', 'headers'));
    }


    public function teachersSchedule()
    {
        // $subjects = Subject::where('teacher_id', auth()->user()->id)->get();
        // $schedules = StudentSchedule::all();


        // return view('teacher.teachersSchedule');
    }


    public function showOne(string $teacher_id)
    {
        $teacherlist = User::where('id', $teacher_id)->get();

        $teacher = $teacherlist[0];

        echo $teacher->name . "<br>";
        echo $teacher->surname . "<br>";
        echo $teacher->email . "<br><br>";
    }


    public function listsTeachers()
    {
        $currentPage = request()->query('page', 1);
        $data = User::where('user_type', 'teacher')
            ->paginate(config('app.pagination_count'), ['*'], 'page', $currentPage);

        $headers = [
            'id' => 'id',
            'name' => 'Nombre',
            'surname' => 'Apellido',
            'email' => 'Email',
            'telephone1' => 'Telefono 1',
            'telephone2' => 'Telefono 2',
        ];


        if (auth()->user()->can('admin')) {
            $actions = [
                'delete' => 'admin.deleteTeacher',
                'edit' => 'admin.editUser',
            ];
        } else {
            $actions = [
            ];
        }
        $title = 'Listado de Profesores';
        return view('admin.listTableData', compact('title', 'data', 'headers', 'actions'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
