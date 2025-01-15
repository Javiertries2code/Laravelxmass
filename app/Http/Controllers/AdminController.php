<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


use Spatie\Permission\Models\Role;



class AdminController extends Controller
{
    public function listsStudents(){
         $students = User::where('user_type', 'student')->get();


            $headers = ['id', 'Nombre', 'Apellido', 'Email', 'Telefono 1', 'Telefono 2', 'ID de Matricula', ];

            return view('admin.listsStudents', compact('students', 'headers'));
        }

        public function listsUsers(){
            $students = User::all();


               $headers = ['id', 'Nombre', 'Apellido', 'Email','tipo de usuario' ,'Telefono 1', 'Telefono 2', 'ID de Matricula', ];

               return view('admin.listsUsers', compact('students', 'headers'));
           }



          public function editUser(string $id){

              $editstudent = User::find( $id);


              $roles = Role::all();

              $student = User::find($id);
            //  return view('admin.editStudent', compact('student'));
            return view('admin.editUser', compact('student', 'roles'));

          }


          public function createUser(){
            $roles = Role::all();
            //dd($roles);
            return view('admin.createUser', compact('roles'));


              }


        public function editStudent(string $id){
          //  echo "oneditstudent";
           // dd($id);
            $editstudent = User::find( $id);

            ///
            //$roles = Role::all();

            $student = User::find($id);
            return view('admin.editStudent', compact('student'));
         // return view('admin.editStudent', compact('student', 'roles'));
////
           // dd($editstudent);
           // return view('admin.editStudent', ['student' => $editstudent]);
        }

        public function deleteStudent(string $id){
           // dd($id);
            $student = User::find($id);
            $student->delete();
            return redirect()->route('admin.listsStudents');
        }


        public function deleteUser(string $id){
            // dd($id);
             $student = User::find($id);
             $student->delete();
             return redirect()->route('admin.listsUsers');
         }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
        // $roles = Role::whereIn('id', $request->roles)->get();

        // $student->syncRoles($roles);
        $student->save();
        return redirect()->route('admin.listsStudents');
    }

    public function updateUser(Request $request, string $id)
    {
        $student = User::find($id);
        $student->name = $request->name;
        $student->surname = $request->surname;
        $student->email = $request->email;

        $student->telephone1 = $request->telephone_1;
        $student->telephone2 = $request->telephone_2;
        $student->registration_id = $request->registration_id;
if ($student->user_type == 'student') {


    return redirect()->route('admin.listsUsers');

} else {
     $roles = Role::whereIn('id', $request->roles)->get();

        $student->syncRoles($roles);
        $student->save();
        return redirect()->route('admin.listsUsers');
}



    }
}
