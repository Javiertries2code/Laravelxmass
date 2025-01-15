<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function roleDelete(Request $request)
    {
        Role::where('name', $request->name)->delete();
        return $this->redirectWithRoles();
    }

    public function storeRole(Request $request)
    {
        Role::create(['name' => $request->name]);
        return $this->redirectWithRoles();
    }

    public function showRoles()
    {
        return $this->redirectWithRoles();
    }

    private function redirectWithRoles()
    {
        $roles = Role::all();
        return view('admin.roles', compact('roles'));
    }

    public function listsStudents()
    {
        $students = User::where('user_type', 'student')->get();
        $headers = ['id', 'Nombre', 'Apellido', 'Email', 'Telefono 1', 'Telefono 2', 'ID de Matricula'];
        return view('admin.listsStudents', compact('students', 'headers'));
    }

    public function listsUsers()
    {
        $students = User::all();
        $headers = ['id', 'Nombre', 'Apellido', 'Email', 'tipo de usuario', 'Telefono 1', 'Telefono 2', 'ID de Matricula'];
        return view('admin.listsUsers', compact('students', 'headers'));
    }

    public function editUser(string $id)
    {
        $editstudent = User::find($id);
        $roles = Role::all();
        if (!auth()->user()->hasRole('god')) {
            $roles = $roles->filter(function ($role) {
                return $role->name != 'god';
            });
        }
        $student = User::find($id);
        return view('admin.editUser', compact('student', 'roles'));
    }

    public function createUser()
    {
        $roles = Role::all();
        return view('admin.createUser', compact('roles'));
    }

    public function editStudent(string $id)
    {
        $editstudent = User::find($id);
        $student = User::find($id);
        return view('admin.editStudent', compact('student'));
    }

    public function deleteStudent(string $id)
    {
        $student = User::find($id);
        $student->delete();
        return redirect()->route('admin.listsStudents');
    }

    public function deleteUser(string $id)
    {
        $student = User::find($id);
        if ($student->hasRole('god')) {
            return redirect()->route('admin.listsUsers')->with('error', 'No se puede eliminar el usuario con rol god');
        }
        $student->delete();
        return redirect()->route('admin.listsUsers');
    }

    public function create()
    {
    }

    public function storeNewUser(Request $request)
    {
        $newUser = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'user_type' => $request->user_type,
            'telephone1' => $request->telephone_1,
            'telephone2' => $request->telephone_2,
            'registration_id' => $request->registration_id,
            'password' => Hash::make('password')
        ]);
        $roles = Role::whereIn('id', $request->roles)->get();
        $newUser->syncRoles($roles);
        return redirect()->route('admin.listsUsers');
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

    public function adminhome()
    {
        return view('admin.adminhome');
    }

    public function studenthome()
    {
        return view('student.studenthome');
    }

    public function teacherhome()
    {
        return view('teacher.teacherhome');
    }
}
