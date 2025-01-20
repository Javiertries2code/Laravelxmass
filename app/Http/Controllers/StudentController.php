<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class StudentController extends AdminController
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
        $student = User::find($id);
        $student->delete();
        return redirect()->route('listsStudents');
    }


    public function studenthome()
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('home');
        }
        $matriculaciones = \App\Models\Registration::where('student_id', $user->id)
            ->orderByDesc('day')
            ->get();

        return view('student.studenthome', compact('user', 'matriculaciones',));
    }

    public function studenListForCurrentTecher()
    {

        $user = auth()->user();

        if ($user && $user->can('teacher')) {

            // Qeury hecha a mano. De momento es chapucero, I'm aware.
            // Espero poder mejorarlo pero de momento este paso a paso funciona

            // reoger las asignaturas asociadas a este profe
            $subject_ids = \App\Models\Subject::where('teacher_id', $user->id)->pluck('id');
            $subjects = \App\Models\Subject::where('teacher_id', $user->id)->get();
            // buscar cada curso que pertenezca a las asignaturas
            $coursesBySubject = [];
            foreach ($subjects as $subject) {
                $courses = $subject->courses()->get()->toArray();
                $coursesBySubject = array_merge($coursesBySubject, $courses); //$courses;
            }
            // buscar en las matriculaciones los estudiantes registrados a esos cursos
            $student_ids = \App\Models\Registration::whereIn('course_id', array_column($coursesBySubject, 'id'))
                ->pluck('student_id')->toArray();

            // aplicar los estudiantes a la data que queremos mostrar en la tabla
            $currentPage = request()->query('page', 1);
            $data = User::where('user_type', 'student')
                ->whereIn('id', $student_ids)
                ->paginate(config('app.pagination_count'), ['*'], 'page', $currentPage);

            $headers = [
                'id' => 'id',
                'name' => 'Nombre',
                'surname' => 'Apellido',
                'email' => 'Email',
                'telephone1' => 'Telefono 1',
                'telephone2' => 'Telefono 2',
            ];

            $actions = [];

            $title = 'Listado de Estudiantes';
            return view('admin.listTableData', compact('title', 'data', 'headers', 'actions'));
        }
        return redirect()->route('home');
    }
}
