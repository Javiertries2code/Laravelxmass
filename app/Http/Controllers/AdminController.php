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
        $currentPage = request()->query('page', 1);
        $data = User::where('user_type', 'student')
            ->paginate(config('app.pagination_count'), ['*'], 'page', $currentPage);

        $headers = [
            'id' => 'id',
            'name' => 'Nombre',
            'surname' => 'Apellido',
            'email' => 'Email',
            'telephone1' => 'Telefono 1',
            'telephone2' => 'Telefono 2',
            'registration_id' => 'ID de Matricula',
        ];

        $actions = [
            'delete' => 'admin.deleteStudent',
            'edit' => 'admin.editStudent',
        ];

        $title = 'Listado de Estudiantes';
        return view('admin.listTableData', compact('title', 'data', 'headers', 'actions'));
    }



    public function listsUsers()
    {
        $currentPage = request()->query('page', 1);
        $data = User::paginate(config('app.pagination_count'), ['*'], 'page', $currentPage);
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
            'create' => 'admin.createUser',
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
        $user = User::find($id);
        return view('admin.editUser', compact('user', 'roles'));
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
        return redirect()->route('admin.listsStudents')->with('success', 'El estudiante ha sido eliminado correctamente.');
    }

    public function deleteTeacher(string $id)
    {
        $teacher = User::find($id);
        $teacher->delete();
        return redirect()->route('teacher.listsTeachers')->with('success', 'El profesor ha sido eliminado correctamente.');
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
            'telephone1' => $request->telephone1,
            'telephone2' => $request->telephone2,
            'registration_id' => $request->registration_id,
            'password' => Hash::make('password'),
        ]);
        $roles = Role::whereIn('id', $request->roles)->get();
        $newUser->syncRoles($roles);
        return redirect()->route('admin.listsUsers')->with('success', 'El usuario ha sido creado correctamente.');
    }
    public function updateStudent(Request $request, string $id)
    {

        $student = User::find($id);
        $student->name = $request->name;
        $student->surname = $request->surname;
        $student->email = $request->email;
        $student->telephone1 = $request->telephone1;
        $student->telephone2 = $request->telephone2;
        $student->registration_id = $request->registration_id;
        $student->save();
        return redirect()->route('admin.listsStudents')->with('success', 'El estudiante ha sido actualizado correctamente.');
    }
    public function updateUser(Request $request, string $id)
    {
        $student = User::find($id);
        $student->name = $request->name;
        $student->surname = $request->surname;
        $student->email = $request->email;
        $student->telephone1 = $request->telephone1;
        $student->telephone2 = $request->telephone2;
        $student->registration_id = $request->registration_id;
        if ($student->user_type == 'student' || null == $request->roles) {
            return redirect()->route('admin.listsUsers')->with('success', 'El usuario ha sido actualizado correctamente.');
        } else {
            $roles = Role::whereIn('id', $request->roles)->get();
            $student->syncRoles($roles);
            $student->save();
            return redirect()->route('admin.listsUsers')->with('success', 'El usuario ha sido actualizado correctamente.');
        }
    }

    public function adminhome()
    {
        // Le pasamos todas cards con boxes y en la vista los iteramos
        $cards = self::getCardsForDashboard();

        return view('admin.adminhome', compact('cards'));
    }

    public function studenthome()
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('home');
        }
        $matriculaciones = Registration::where('student_id', $user->id)->get();
        foreach ($matriculaciones as $registration) {
            $course = Course::find($registration->course_id);
            $registration->course_name_str = $course ? $course->name : 'Curso no encontrado';
        }


        return view('student.studenthome', compact('user', 'matriculaciones',));
    }

    public function teacherhome()
    {
        return view('teacher.teacherhome');
    }

    public static function getCardsForDashboard()
    {
        return [
            [
                'icon' => 'bi bi-book',
                'title' => 'Cursos',
                'text' => 'Ver cursos',
                'count' => Course::all()->count(),
                'route' => route('course.coursesList')
            ],
            [
                'icon' => 'bi bi-person',
                'title' => 'Usuarios',
                'active' => request()->routeIs('admin.editUser', 'admin.listsUsers'),
                'text' => 'Ver usuarios',
                'count' => User::all()->count(),
                'route' => route('admin.listsUsers')
            ],
            [
                'icon' => 'bi bi-people',
                'title' => 'Estudiantes',
                'active' => request()->routeIs('admin.editStudent', 'admin.listsStudents'),
                'text' => 'Ver estudiantes',
                'count' => User::where('user_type', 'student')->count(),
                'route' => route('admin.listsStudents')
            ],
            [
                'icon' => 'bi bi-people',
                'title' => 'Profesores',
                'active' => request()->routeIs('admin.editTeacher', 'admin.listsTeachers'),
                'text' => 'Ver profesores',
                'count' => User::where('user_type', 'teacher')->count(),
                'route' => route('teacher.listsTeachers')
            ],
            [
                'icon' => 'bi bi-gear',
                'title' => 'Roles',
                'text' => 'Ver roles',
                'count' => Role::all()->count(),
                'route' => route('admin.roles')
            ],
            [
                'icon' => 'bi bi-calendar-event',
                'title' => 'Reuniones',
                'active' => str_contains(request()->route()->uri(), 'meeting'),
                'text' => 'Ver reuniones',
                'count' => \App\Models\Meeting::all()->count(),
                'route' => route('meeting.index')
            ],
            [
                'icon' => 'bi bi-bookmark',
                'title' => 'Asignaturas',
                'text' => 'Ver asignaturas',
                'count' => Subject::all()->count(),
                'route' => route('subjects.subjectsList')
            ],
            [
                'icon' => 'bi bi-clipboard-data',
                'title' => 'Matriculaciones',
                'active' => str_contains(request()->route()->uri(), 'registration'),
                'text' => 'Ver matriculaciones',
                'count' => Registration::all()->count(),
                'route' => route('admin.registrationList')
            ],
        ];
    }

    public function deleteMeeting(string $id)
    {
        $meeting = Meeting::find($id);
        return redirect()->route('meeting.index')->with('success', 'El meeting ha sido eliminado correctamente.');
    }

    public function registrationList()
    {
        $currentPage = request()->query('page', 1);
        $data = \App\Models\Registration::paginate(config('app.pagination_count'), ['*'], 'page', $currentPage);

        foreach ($data as $registration) {
            $registration->student_name = '<a href="'
                . route('student.registrationListByStudent', $registration->student_id) . '"> '
                . User::find($registration->student_id)->name
                . '</a>';
            $registration->course_name = Course::find($registration->course_id)->name;
            $registration->day_readable_by_human = date('l, j F Y', strtotime($registration->day));
        }
        $headers = [
            'id' => 'ID',
            'student_name' => 'Estudiante',
            'course_name' => 'Curso',
            'day_readable_by_human' => 'Fecha de inicio',
        ];
        $actions = [
            'create' => 'admin.registrationNew', // Adjust route names as needed
            'edit' => 'admin.registrationEdit',
            'delete' => 'admin.registrationDelete'
        ];
        $title = 'Listado de Matriculaciones';
        return view('admin.listTableData', compact('title', 'data', 'headers', 'actions'));
    }


    public function registrationNew()
    {
        $courses = Course::all();
        $students = User::where('user_type', '=', 'student')->get();
        return view('admin.registrationNew', compact('courses', 'students'));
    }


    // crear nuevo Logica:
    public function registrationStore(Request $request)
    {
        // Aqui  verificar que otro registro con el mismo student_id
        // y el mismo course_id no exsta ya, pero sin contar el que es pasado en request
        // porque es el que estamos editando ahora
        $existingRegistration = Registration::where('student_id', '=', $request->student_id)
            ->where('course_id', '=', $request->course_id)
            ->where('id', '!=', $request->id)
            ->first();

        if ($existingRegistration) {
            return redirect()->route('admin.registrationList')->with('error', 'Ya existe una matriculación para este estudiante en este curso.');
        }

        try {
            $registration = new Registration();
            $registration->student_id = (int) $request->student_id;
            $registration->course_id = (int) $request->course_id;
            $registration->day = $request->day;
            $registration->save();
        } catch (ValidationException $e) {

            return redirect()->route('admin.registrationList')->withErrors($e->validator);
        }

        if ($registration && $request->student_id && $request->course_id) {
            return redirect()->route('admin.registrationList')->with('success', 'La matricula con ID ' . $registration->id . ' ha sido creada correctamente.');
        } else {
            return redirect()->route('admin.registrationList')->with('error', 'Hubo un error al crear la matricula. Intente de nuevo.');
        }
    }


    public function registrationUpdate(Request $request)
    {


        // Aqui  verificar que otro registro con el mismo student_id
        // y el mismo course_id no exsta ya, pero sin contar el que es pasado en request
        // porque es el que estamos editando ahora
        $existingRegistration = Registration::where('student_id', '=', $request->student_id)
            ->where('course_id', '=', $request->course_id)
            ->where('id', '!=', $request->id)
            ->first();

        if ($existingRegistration) {
            return redirect()->route('admin.registrationList')->with('error', 'Ya existe una matriculación para este estudiante en este curso.');
        }

        try {
            $registration = Registration::findOrFail($request->id);
            $registration->update([
                'student_id' => (int) $request->student_id,
                'course_id' => (int) $request->course_id,
                'day' => $request->day,
            ]);
        } catch (ValidationException $e) {

            return redirect()->route('admin.registrationList')->withErrors($e->validator);
        }

        if ($registration && $request->student_id && $request->course_id) {
            return redirect()->route('admin.registrationList')->with('success', 'La matricula con ID ' . $registration->id . ' ha sido actualizada correctamente.');
        } else {
            return redirect()->route('admin.registrationList')->with('error', 'Hubo un error al actualizar la matricula. Intente de nuevo.');
        }
    }




    public function registrationEdit($id)
    {
        $registration = Registration::findOrFail($id);
        $courses = Course::all();
        $students = User::where('user_type', '=', 'student')->get();
        $stundent_assigned = User::where('id', '=', $registration->student_id)->first();
        return view('admin.registrationEdit', compact('registration', 'courses', 'students', 'stundent_assigned'));
    }


    public function registrationListByStudent($student_id)
    {
        $student = User::findOrFail($student_id);
        $title = 'Listado de Matriculaciones de ' . $student->name;
        $currentPage = request()->query('page', 1);

        $data = Registration::where('student_id', $student_id)->paginate(config('app.pagination_count'), ['*'], 'page', $currentPage);

        foreach ($data as $registration) {
            $registration->student_name = '<a href="'
                . route('student.registrationListByStudent', $registration->student_id) . '"> '
                . User::find($registration->student_id)->name
                . '</a>';
            $registration->course_name = Course::find($registration->course_id)->name;
            $registration->day_readable_by_human = date('l, j F Y', strtotime($registration->day));
        }
        $headers = [
            'id' => 'ID',
            'student_name' => 'Estudiante',
            'course_name' => 'Curso',
            'day_readable_by_human' => 'Fecha de inicio',
        ];
        $actions = [
            'create' => 'admin.registrationNew', // Adjust route names as needed
            'edit' => 'admin.registrationEdit',
            'delete' => 'admin.registrationDelete'
        ];

        return view('admin.listTableData', compact('title', 'data', 'headers', 'actions'));
    }


    public function registrationDelete(Request $request)
    {
        $id = $request->id;
        $registration = Registration::findOrFail($id);
        $registration->delete();
        return redirect()->route('admin.registrationList')->with('success', 'La matricula con ID ' . $id . ' ha sido eliminada correctamente.');
    }
}
