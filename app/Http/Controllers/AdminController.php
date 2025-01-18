<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\Registration;
use App\Models\Course;
use App\Models\Subject;

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
        $students = User::where('user_type', 'student')->paginate(10);
        $headers = ['id', 'Nombre', 'Apellido', 'Email', 'Telefono 1', 'Telefono 2', 'ID de Matricula'];
        return view('admin.listsStudents', compact('students', 'headers'));
    }

    public function listsUsers()
    {
        $currentPage = request()->query('page', 1);
        $data = User::paginate(15, ['*'], 'page', $currentPage);
        foreach ($data as $user) {
            $roles = $user->getRoleNames()->toArray(); // [ 'god', 'teacher', 'student' ]
            $user->roles_to_str = '';
            foreach ($roles as $i => $role) {
                $role =  $role === 'god' ? "<b class='text-danger'>GOD</b>" : $role;
                $user->roles_to_str = $user->roles_to_str . $role . ', ';
            }
        }
        $headers = [
            'id' => 'id',
            'name' => 'Nombre',
            'surname' => 'Apellido',
            'email' => 'Email',
            'user_type' => 'Tipo de usuario',
            'roles_to_str' => 'Roles',
            'telephone1' => 'Telefono 1',
            'telephone2' => 'Telefono 2',
        ];
        $actions = [
            'delete' => 'admin.deleteUser',
            'edit' => 'admin.editUser',
        ];

        $title = 'Listado de Usuarios';
        return view('admin.listTableData', compact('title', 'data', 'headers', 'actions'));
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
        return redirect()->route('admin.listsUsers')->with('success', 'El usuario ha sido eliminado correctamente.');
    }

    public function create() {}

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
        if ($student->user_type == 'student' || null == $request->roles) {
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
        // Le pasamos todas cards con boxes y en la vista los iteramos
        $data = self::getCardsForDashboard();

        return view('admin.adminhome', compact('data'));

    }

    public function studenthome()
    {
        $user = auth()->user();
        $courses_ids = Registration::where('student_id', $user->id)->get()->pluck('course_id');

        $courses = Course::all()->where('id', $courses_ids[0])->load('subjects');



        return view('student.studenthome', compact('user', 'courses'));
    }

    public function teacherhome()
    {
        return view('teacher.teacherhome');
    }

    public static function getCardsForDashboard() {
        return [
            [
                'icon' => 'bi bi-book',
                'title' => 'Cursos',
                'text' => 'Ver cursos',
                'route' => route('course.coursesList')
            ],
            [
                'icon' => 'bi bi-person',
                'title' => 'Usuarios',
                'text' => 'Ver usuarios',
                'route' => route('admin.listsUsers')
            ],
            [
                'icon' => 'bi bi-people',
                'title' => 'Estudiantes',
                'text' => 'Ver estudiantes',
                'route' => route('admin.listsStudents')
            ],
            [
                'icon' => 'bi bi-gear',
                'title' => 'Roles',
                'text' => 'Ver roles',
                'route' => route('admin.roles')
            ],
            [
                'icon' => 'bi bi-calendar-event',
                'title' => 'Reuniones',
                'text' => 'Ver reuniones',
                'route' => route('meeting.index')
            ]
        ];
    }
}
