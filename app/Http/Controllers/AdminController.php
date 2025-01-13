<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function listsStudents(){
        // $students = User::where('user_type', 'student')->get();

        // return view('admin.listsStudents', ['students' => $students ]);

            $students = \App\Models\User::all()->map(function ($student) {
                return [
                    'id' => $student->id,
                    'Nombre' => $student->name,
                    'Apellido' => $student->surname,
                    'Email' => $student->email,
                    'Telefono 1' => $student->telephone_1,
                    'Telefono 2' => $student->telephone_2,
                    'ID de Matricula' => $student->registration_id,
                ];
            });

            $headers = ['id', 'Nombre', 'Apellido', 'Email', 'Telefono 1', 'Telefono 2', 'ID de Matricula', 'Acciones'];

            return view('admin.listsStudents', compact('students', 'headers'));
        }

        public function editStudent($id){
            dd($id);
            $student = User::find($id);
            return view('admin.editStudent', ['student' => $student]);
        }
        public function deleteStudent(string $id){
            $student = User::find($id);
            $student->delete();
            return redirect()->route('listsStudents');
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
