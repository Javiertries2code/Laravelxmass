<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function listsStudents(){
         $students = User::where('user_type', 'student')->get();


            $headers = ['id', 'Nombre', 'Apellido', 'Email', 'Telefono 1', 'Telefono 2', 'ID de Matricula', ];

            return view('admin.listsStudents', compact('students', 'headers'));
        }

        public function editStudent(string $id){
          //  echo "oneditstudent";
           // dd($id);
            $editstudent = User::find( $id);
           // dd($editstudent);
            return view('admin.editStudent', ['student' => $editstudent]);
        }

        public function deleteStudent(string $id){
           // dd($id);
            $student = User::find($id);
            $student->delete();
            return redirect()->route('admin.listsStudents');
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


    public function updateStudent(Request $request, string $id)
    {
        $student = User::find($id);
        $student->name = $request->name;
        $student->surname = $request->surname;
        $student->email = $request->email;

        $student->telephone1 = $request->telephone_1;
        $student->telephone2 = $request->telephone_2;
        $student->registration_id = $request->registration_id;
        $student->save();
        return redirect()->route('admin.listsStudents');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
